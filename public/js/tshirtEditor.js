var canvas;
var sideCanvas;
var tshirts = new Array(); //prototype: [{style:'x',color:'white',front:'a',back:'b',price:{tshirt:'12.95',frontPrint:'4.99',backPrint:'4.99',total:'22.47'}}]
var a;
var b;
var line1;
var line2;
var line3;
var line4;
var tempColor;

var logoCount = 0;
var logoPrice = 150;

var defaultColor = '#ffffff';

var frontLink;
var backLink;
var leftLink;
var rightLink;
 	$(document).ready(function() {
		//setup front side canvas 
 		canvas = new fabric.Canvas('frontCanvas', {
		  hoverCursor: 'pointer',
		  selection: true,
		  selectionBorderColor:'blue'
		});

        backCanvas = new fabric.Canvas('backCanvas', {
            hoverCursor: 'pointer',
            selection: true,
            selectionBorderColor:'blue'
        });
        leftCanvas = new fabric.Canvas('leftCanvas', {
            hoverCursor: 'pointer',
            selection: true,
            selectionBorderColor:'blue'
        });
        rightCanvas = new fabric.Canvas('rightCanvas', {
            hoverCursor: 'pointer',
            selection: true,
            selectionBorderColor:'blue'
        });
 		canvas.on({
			 'object:moving': function(e) {
                 canvas.renderAll();

			  },
			  'object:modified': function(e) {
			    e.target.opacity = 1;
			  },
			 'object:selected':onObjectSelected,
			 'selection:cleared':onSelectedCleared
		 });
        backCanvas.on({
            'object:moving': function(e) {
                backCanvas.renderAll();

            },
            'object:modified': function(e) {
                e.target.opacity = 1;
            },
            'object:selected':onObjectSelected,
            'selection:cleared':onSelectedCleared
        });



		// piggyback on `canvas.findTarget`, to fire "object:over" and "object:out" events
 		canvas.findTarget = (function(originalFn) {
		  return function() {
		    var target = originalFn.apply(this, arguments);
		    if (target) {
		      if (this._hoveredTarget !== target) {
		    	  canvas.fire('object:over', { target: target });
		        if (this._hoveredTarget) {
		        	canvas.fire('object:out', { target: this._hoveredTarget });
		        }
		        this._hoveredTarget = target;
		      }
		    }
		    else if (this._hoveredTarget) {
		    	canvas.fire('object:out', { target: this._hoveredTarget });
		      this._hoveredTarget = null;
		    }
		    return target;
		  };
		})(canvas.findTarget);

        // piggyback on `canvas.findTarget`, to fire "object:over" and "object:out" events
        backCanvas.findTarget = (function(originalFn) {
            return function() {
                var target = originalFn.apply(this, arguments);
                if (target) {
                    if (this._hoveredTarget !== target) {
                        backCanvas.fire('object:over', { target: target });
                        if (this._hoveredTarget) {
                            backCanvas.fire('object:out', { target: this._hoveredTarget });
                        }
                        this._hoveredTarget = target;
                    }
                }
                else if (this._hoveredTarget) {
                    backCanvas.fire('object:out', { target: this._hoveredTarget });
                    this._hoveredTarget = null;
                }
                return target;
            };
        })(backCanvas.findTarget);

 		canvas.on('object:over', function(e) {		
		  //e.target.setFill('red');
		  //canvas.renderAll();
		});
		
 		canvas.on('object:out', function(e) {		
		  //e.target.setFill('green');
		  //canvas.renderAll();
		});

        backCanvas.on('object:over', function(e) {
            //e.target.setFill('red');
            //canvas.renderAll();
        });

        backCanvas.on('object:out', function(e) {
            //e.target.setFill('green');
            //canvas.renderAll();
        });
		 		 	 
		document.getElementById('add-text').onclick = function() {
			var text = $("#text-string").val();
		    var textSample = new fabric.Text(text, {
		      left: fabric.util.getRandomInt(0, 200),
		      top: fabric.util.getRandomInt(0, 400),
		      fontFamily: 'helvetica',
		      angle: 0,
		      fill: '#000000',
		      scaleX: 0.5,
		      scaleY: 0.5,
		      fontWeight: '',
	  		  hasRotatingPoint:true
		    });

            if ($('#flip').attr("data-original-title") == "Show Back View") {
                canvas.add(textSample);
                canvas.item(canvas.item.length-1).hasRotatingPoint = true;
                $("#texteditor").css('display', 'block');
                $("#imageeditor").css('display', 'block');

                canvas.renderAll();

            } else {
                backCanvas.add(textSample);
                backCanvas.item(backCanvas.item.length-1).hasRotatingPoint = true;
                $("#texteditor").css('display', 'block');
                $("#imageeditor").css('display', 'block');

                backCanvas.renderAll();
            }
            logoCount++;
            addLogoToTable(logoCount);
	  	};
	  	$("#text-string").keyup(function(){	  		
	  		var activeObject = canvas.getActiveObject();
		      if (activeObject && activeObject.type === 'text') {
		    	  activeObject.text = this.value;
		    	  canvas.renderAll();
		      }
	  	});
	  	$(".img-polaroid").click(function(e){
	  		var el = e.target;
	  		/*temp code*/
	  		var offset = 50;
	        var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
	        var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
	        var angle = fabric.util.getRandomInt(-20, 40);
	        var width = fabric.util.getRandomInt(30, 50);
	        var opacity = (function(min, max){ return Math.random() * (max - min) + min; })(0.5, 1);
	        
	  		fabric.Image.fromURL(el.src, function(image) {
		          image.set({
		            left: left,
		            top: top,
		            angle: 0,
		            padding: 10,
		            cornersize: 10,
	      	  		hasRotatingPoint:true
		          });
		          //image.scale(getRandomNum(0.1, 0.25)).setCoords();
				console.log('here')


				if ($('#flip').attr("data-original-title") == "Show Back View") {
                    canvas.add(image);
                    canvas.renderAll();
				} else {
                    backCanvas.add(image);
                    backCanvas.renderAll();
				}


		        });
	  		logoCount++;
            addLogoToTable(logoCount);
	  	});
        $(".img-tshirt").click(function(e){
            $('#frontDrawingArea').show();
            $('#backDrawingArea').hide();
            $('#leftDrawingArea').hide();
            $('#rightDrawingArea').hide();
            canvas.clear();
            var el = e.target;
            /*temp code*/
            var offset = 50;
            // var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
            // var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
            // var angle = fabric.util.getRandomInt(-20, 40);
            // var width = fabric.util.getRandomInt(30, 50);
            // var opacity = (function(min, max){ return Math.random() * (max - min) + min; })(0.5, 1);

            fabric.Image.fromURL(el.src, function(image) {
                image.set({
                    left: 100,
                    top: 200,
                    angle: 0,
                    padding: 10,
                    cornersize: 10,
                    scaleX: 450 / image.width,
                    scaleY: 450 / image.height,
                    hasRotatingPoint:true
                });
                canvas.add(image);
                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                canvas.renderAll();

                frontLink = canvas.toDataURL('image/png');
            });

            renderBackCanvas();
            renderLeftCanvas();
            renderRightCanvas();
        });
	  document.getElementById('remove-selected').onclick = function() {
	  		if($('#flip').attr("data-original-title") == "Show Back View") {
                var activeObject = canvas.getActiveObject(),
                    activeGroup = canvas.getActiveGroup();
                if (activeObject) {
                    canvas.remove(activeObject);
                    $("#text-string").val("");
                }
                else if (activeGroup) {
                    var objectsInGroup = activeGroup.getObjects();
                    canvas.discardActiveGroup();
                    objectsInGroup.forEach(function(object) {
                        canvas.remove(object);
                    });
                }
			} else {
                var activeObject = backCanvas.getActiveObject(),
                    activeGroup = backCanvas.getActiveGroup();
                if (activeObject) {
                    backCanvas.remove(activeObject);
                    $("#text-string").val("");
                }
                else if (activeGroup) {
                    var objectsInGroup = activeGroup.getObjects();
                    backCanvas.discardActiveGroup();
                    objectsInGroup.forEach(function(object) {
                        backCanvas.remove(object);
                    });
                }
			}
          removeLogoToTable(logoCount);
          logoCount--;
	  };
	  document.getElementById('bring-to-left').onclick = function() {
          $('.logoList').hide();
          $('#frontDrawingArea').hide();
          $('#backDrawingArea').hide();
          $('#leftDrawingArea').show();
          $('#rightDrawingArea').hide();
          renderLeftCanvas();


	  };
	  document.getElementById('bring-to-right').onclick = function() {
          $('.logoList').hide();
          $('#frontDrawingArea').hide();
          $('#backDrawingArea').hide();
          $('#leftDrawingArea').hide();
          $('#rightDrawingArea').show();
          renderRightCanvas();


	  };
	  $("#text-bold").click(function() {
		  if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
                  canvas.renderAll();
              }
		  } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
                  backCanvas.renderAll();
              }
		  }

		});
	  $("#text-italic").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
                  backCanvas.renderAll();
              }
          }

		});
	  $("#text-strike").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
                  backCanvas.renderAll();
              }
          }

		});
	  $("#text-underline").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
                  backCanvas.renderAll();
              }
          }

		});
	  $("#text-left").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'left';
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'left';
                  backCanvas.renderAll();
              }
          }

		});
	  $("#text-center").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'center';
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'center';
                  backCanvas.renderAll();
              }
          }

		});
	  $("#text-right").click(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'right';
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.textAlign = 'right';
                  backCanvas.renderAll();
              }
          }

		});	  
	  $("#font-family").change(function() {
          if($('#flip').attr("data-original-title") == "Show Back View") {
              var activeObject = canvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontFamily = this.value;
                  canvas.renderAll();
              }
          } else {
              var activeObject = backCanvas.getActiveObject();
              if (activeObject && activeObject.type === 'text') {
                  activeObject.fontFamily = this.value;
                  backCanvas.renderAll();
              }
          }

	    });	  
		$('#text-bgcolor').miniColors({
			change: function(hex, rgb) {
                if($('#flip').attr("data-original-title") == "Show Back View") {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.backgroundColor = this.value;
                        canvas.renderAll();
                    }
                } else {
                    var activeObject = backCanvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.backgroundColor = this.value;
                        backCanvas.renderAll();
                    }
                }

			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});		
		$('#text-fontcolor').miniColors({
			change: function(hex, rgb) {
                if($('#flip').attr("data-original-title") == "Show Back View") {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.fill = this.value;
                        canvas.renderAll();
                    }
                } else {
                    var activeObject = backCanvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.fill = this.value;
                        backCanvas.renderAll();
                    }
                }

			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});
		
		$('#text-strokecolor').miniColors({
			change: function(hex, rgb) {
                if($('#flip').attr("data-original-title") == "Show Back View") {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.strokeStyle = this.value;
                        canvas.renderAll();
                    }
                } else {
                    var activeObject = backCanvas.getActiveObject();
                    if (activeObject && activeObject.type === 'text') {
                        activeObject.strokeStyle = this.value;
                        backCanvas.renderAll();
                    }
                }

			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});
	
		//canvas.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:false,selectable:false,type:'rect'}));
	   // $("#drawingArea").hover(
	   //      function() {
	   //      	 canvas.add(line1);
		//          canvas.add(line2);
		//          canvas.add(line3);
		//          canvas.add(line4);
		//          canvas.renderAll();
	   //      }
	   //      ,
	   //      function() {
	   //      	 canvas.remove(line1);
		//          canvas.remove(line2);
		//          canvas.remove(line3);
		//          canvas.remove(line4);
		//          canvas.renderAll();
	   //      }
	   //  );
	   
	   $('.color-preview').click(function(){
		   var color = $(this).css("background-color");
		   // document.getElementById("shirtDiv").style.backgroundColor = color;
		   canvas.backgroundColor = color;
           backCanvas.backgroundColor = color;
           leftCanvas.backgroundColor = color;
           rightCanvas.backgroundColor = color;
           tempColor = color;
           canvas.renderAll();
	   });
	   
	   $('#flip').click(
		   function() {
               $('.logoList').show();
               $("#texteditor").css('display', 'none');
               $('#frontDrawingArea').hide();
               $('#backDrawingArea').show();
               $('#leftDrawingArea').hide();
               $('#rightDrawingArea').hide();
			   	if ($(this).attr("data-original-title") == "Show Back View") {
                    $(this).attr('data-original-title', 'Show Front View');
			   		renderBackCanvas();
                    a = JSON.stringify(backCanvas);
                    backCanvas.clear();
                    try
                    {
                        var json = JSON.parse(b);
                        backCanvas.loadFromJSON(a);
                        // backCanvas.renderAll();
                    }
                    catch(e)
                    {}

			        
			    } else {
                    $('#frontDrawingArea').show();
                    $('#backDrawingArea').hide();
                    $('#leftDrawingArea').hide();
                    $('#rightDrawingArea').hide();
                    var fileName = $('.img-tshirt').attr('src');
                    var strToReplace = fileName.substring(fileName.lastIndexOf('_'), fileName.lastIndexOf('.'));
			    	$(this).attr('data-original-title', 'Show Back View');
                    $('#tshirtFacing').attr('src', ($('.img-tshirt').attr('src')).replace(strToReplace, '_front'));
                    fabric.Image.fromURL($('#tshirtFacing').attr('src'), function(image) {
                        image.set({
                            left: 100,
                            top: 200,
                            angle: 0,
                            padding: 10,
                            cornersize: 10,
                            scaleX: 450 / image.width,
                            scaleY: 450 / image.height,
                            hasRotatingPoint: true
                        });

                        canvas.add(image);
                        canvas.backgroundColor = tempColor;
                    });
                    b = JSON.stringify(canvas);
                    canvas.clear();

                    try
                    {
                       var json = JSON.parse(a);
                       canvas.loadFromJSON(b);
                        // backCanvas.renderAll();

                    }
                    catch(e)
                    {}

                    //
			    }
			   	setTimeout(function() {
			   		canvas.calcOffset();
			    },200);			   	
        });	   
	   $(".clearfix button,a").tooltip();
	   line1 = new fabric.Line([0,0,200,0], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line2 = new fabric.Line([199,0,200,399], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line3 = new fabric.Line([0,0,0,400], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line4 = new fabric.Line([0,400,200,399], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});


        $('#frontDownload').click(function() {
            downloadCanvas(this, canvas, 'testfront.png');
        });
        $('#backDownload').click(function() {
            downloadCanvas(this, backCanvas, 'testback.png');
        });
        $('#leftDownload').click(function() {
            downloadCanvas(this, leftCanvas, 'testleft.png');
        });
        $('#rightDownload').click(function() {
            downloadCanvas(this, rightCanvas, 'testright.png');
        });
        $('#addToCart').click(function () {
            $('#frontImage').val(canvas.toDataURL('image/png'));
            $('#backImage').val(backCanvas.toDataURL('image/png'));
            $('#leftImage').val(leftCanvas.toDataURL('image/png'));
            $('#rightImage').val(rightCanvas.toDataURL('image/png'));
        });
 	});//doc ready
	 
	 
	 function getRandomNum(min, max) {
	    return Math.random() * (max - min) + min;
	 }
	 
	 function onObjectSelected(e) {	 
	    var selectedObject = e.target;
	    $("#text-string").val("");
	    selectedObject.hasRotatingPoint = true
	    if (selectedObject && selectedObject.type === 'text') {
	    	//display text editor	    	
	    	$("#texteditor").css('display', 'block');
	    	$("#text-string").val(selectedObject.getText());	    	
	    	$('#text-fontcolor').miniColors('value',selectedObject.fill);
	    	$('#text-strokecolor').miniColors('value',selectedObject.strokeStyle);	
	    	$("#imageeditor").css('display', 'block');
	    }
	    else if (selectedObject && selectedObject.type === 'image'){
	    	//display image editor
	    	$("#texteditor").css('display', 'none');	
	    	$("#imageeditor").css('display', 'block');
	    }
	  }
	 function onSelectedCleared(e){
		 $("#texteditor").css('display', 'none');
		 $("#text-string").val("");
	 }
	 function setFont(font){
		 if($('#flip').attr("data-original-title") == "Show Back View") {
             var activeObject = canvas.getActiveObject();
             if (activeObject && activeObject.type === 'text') {
                 activeObject.fontFamily = font;
                 canvas.renderAll();
             }
		 } else {
             var activeObject = backCanvas.getActiveObject();
             if (activeObject && activeObject.type === 'text') {
                 activeObject.fontFamily = font;
                 backCanvas.renderAll();
             }
		 }

	  }
	 function removeWhite(){
		  var activeObject = canvas.getActiveObject();
		  if (activeObject && activeObject.type === 'image') {			  
			  activeObject.filters[2] =  new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10});//0-255, 0-255
			  activeObject.applyFilters(canvas.renderAll.bind(canvas));
		  }	        
	 }



function downloadCanvas(link, canvasObj, filename) {
	console.log(canvasObj.toDataURL('image/png'));
    link.href = canvasObj.toDataURL('image/png');
    link.download = filename;
}

function renderLeftCanvas () {
    var fileName = $('.img-tshirt').attr('src');
    var strToReplace = fileName.substring(fileName.lastIndexOf('_'), fileName.lastIndexOf('.'));

    $('#tshirtFacing').attr('src', ($('.img-tshirt').attr('src')).replace(strToReplace, '_left'));
    leftCanvas.clear();

    fabric.Image.fromURL($('#tshirtFacing').attr('src'), function(image) {
        image.set({
            left: 100,
            top: 200,
            angle: 0,
            padding: 10,
            cornersize: 10,
            scaleX: 450 / image.width,
            scaleY: 450 / image.height,
            hasRotatingPoint:true
        });
        leftCanvas.add(image);
        leftCanvas.renderAll();
        //image.scale(getRandomNum(0.1, 0.25)).setCoords();
        // console.log('here')
        //
        // leftCanvas.backgroundColor = tempColor;
        // leftLink = leftCanvas.toDataURL('image/png');
    });
}

function renderRightCanvas () {
    var fileName = $('.img-tshirt').attr('src');
    var strToReplace = fileName.substring(fileName.lastIndexOf('_'), fileName.lastIndexOf('.'));

    $('#tshirtFacing').attr('src', ($('.img-tshirt').attr('src')).replace(strToReplace, '_right'));
    rightCanvas.clear();

    fabric.Image.fromURL($('#tshirtFacing').attr('src'), function(image) {
        image.set({
            left: 100,
            top: 200,
            angle: 0,
            padding: 10,
            cornersize: 10,
            scaleX: 450 / image.width,
            scaleY: 450 / image.height,
            hasRotatingPoint:true
        });
        rightCanvas.add(image);
        rightCanvas.renderAll();
        // //image.scale(getRandomNum(0.1, 0.25)).setCoords();
        // console.log('here')
        //
        // rightLink = rightCanvas.toDataURL('image/png');
    });
}

function renderBackCanvas() {
    var fileName = $('.img-tshirt').attr('src');
    var strToReplace = fileName.substring(fileName.lastIndexOf('_'), fileName.lastIndexOf('.'));


    $('#tshirtFacing').attr('src', ($('.img-tshirt').attr('src')).replace(strToReplace, '_back'));
    fabric.Image.fromURL($('#tshirtFacing').attr('src'), function(image) {
        image.set({
            left: 100,
            top: 200,
            angle: 0,
            padding: 10,
            cornersize: 10,
            scaleX: 450 / image.width,
            scaleY: 450 / image.height,
            hasRotatingPoint: true
        });

        backCanvas.add(image);
    });


}

function addToTotal(price) {
    var total = parseFloat($('#totalPrice').val());
    $('#totalPrice').val((total + price).toFixed(2));
}

function removeToTotal(price) {
    var total = parseFloat($('#totalPrice').val())
    $('#totalPrice').val((total - price).toFixed(2));
}

function addLogoToTable(id) {
    $('#priceTable').prepend(
        "<tr id='"+id+"'>\n" +
        "<td>Logo</td>\n" +
        "<td align=\"right\">&#8369;<span id='logoPrice'>"+logoPrice.toFixed(2)+"</span></td>\n" +
        "</tr>"
    );
    addToTotal(logoPrice);
}

function removeLogoToTable(id) {
	$('#' + id).remove();
    removeToTotal(logoPrice);
}