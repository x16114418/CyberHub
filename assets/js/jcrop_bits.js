$(function(){
	  
    $('#jcrop_target').Jcrop({
      aspectRatio: 1,
	  setSelect:   [ 200,200,37,49 ],
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('You must select a crop and submit');
    return false;
  }; 

	function cancelCrop(){
		//if cancel refresh			
		top.location = 'upload.php';
		return false;
	}