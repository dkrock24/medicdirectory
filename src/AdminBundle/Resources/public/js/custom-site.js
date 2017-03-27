$(function() {
	  
	//$('#myModal').modal({backdrop: 'static', keyboard: false})  
	if( $('.image-editor').size() > 0) {
		//alert();
		var btn_loading = "fa fa-spinner fa-spin";
		var btn_default = "fa fa-scissors";

		$('.image-editor').cropit({
			imageState: {
				//src: 'http://lorempixel.com/500/400/',
			},
			onImageLoading: function () { // Called when image starts to be loaded.
				$("#status-cut").removeClass(btn_default).addClass(btn_loading);
				//$("#loading").html("Cargando Imagen");
			},
			onImageLoaded: function () { // Called when image is loaded.
				$("#status-cut").removeClass(btn_loading).addClass(btn_default);
				//$("#loading").html("Ok");
			},
			onFileReaderError: function () { // Called when FileReader encounters an error while loading the image file.
				alert("A ocurrido un error al tratar de leer el archivo");
			},
			onFileChange: function () { // Called when user selects a file in the select file input.
				$("#crop-img").empty();
			},
		});

		$('.rotate-cw').click(function () {
			$('.image-editor').cropit('rotateCW');
		});
		$('.rotate-ccw').click(function () {
			$('.image-editor').cropit('rotateCCW');
		});

		$('.export').click(function () {
			//$("#loading").html("antes");
			var imageData = $('.image-editor').cropit('export');

			if (imageData == undefined || imageData == "" || imageData == null)
			{
			} else
			{
				$('#crop-img').html("<img src='"+imageData+"'>");
				//var imageData = $('.image-editor').cropit('export');
				
				//console.log( imageData );
				$("#loading").html("despues");	
			}


		});

	}
    
    
    
    if( $("#my_camera").size() > 0 )
    {
        Webcam.set({
			width: 250,
			height: 250,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
        
        $("#take_snapshot").on("click",function(){
            // take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = 
					'<div>Foto capturada:</div>' + 
					'<img id="webcam-image" src="'+data_uri+'"/>';
			} );
        });
    }
    
    
    $("#btn-save-crop").on("click",function(){
			
		
        
        if( $("#webcam-image").size() > 0 && $("#webcam-image").is(":visible") )
        {
            var src = $("#webcam-image").attr("src");
            if( src != "")
            {
                $('#avatar-img').attr("src",src);
                $('#myModalPicture').modal('hide');
            }
        }
        else if( $("#crop-img img").size() > 0 && $("#crop-img img").is(":visible") )
        {
            var src = $("#crop-img img").attr("src");
            if( src != "")
            {
                $('#avatar-img').attr("src",src);
                $('#myModalPicture').modal('hide');
            }
        }
        
	});
	
	   
});
