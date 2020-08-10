function search(){
    var destino_info = $('.destino_info').val();
    var entrada_info = $('.entrada_info').val();
    var saida_info = $('.saida_info').val();
    var quartos_info = $('.quartos_info').val();
    if(destino_info){
      if(entrada_info){
        if(saida_info){
          if(quartos_info){
  $('.FnBlurEmabassar').attr('style', 'transition: all 0.5s;-webkit-filter: blur(3px);');
   $('.carregamento').attr('style', 'display:block;');
                  $.ajax({
      url: base+'/assets/ajax/gerarIdSearch.vermais.ajax.php',
      type: 'POST',
      data: { destino_info: destino_info, entrada_info: entrada_info, saida_info: saida_info, quartos_info: quartos_info },
      }).done(function(data) {
       window.location.replace(base+'/Search/'+data);
      }).fail(function() {
      window.location.reload();
    });

          }else{
              $('.--quartos_info').attr('style', 'visibility:visible;opacity:1;');
                 setTimeout(function(){
                   $('.--quartos_info').removeAttr('style');
                 }, 5000);

          }
        }else{
          $('.--saida_info').attr('style', 'visibility:visible;opacity:1;');
            setTimeout(function(){
              $('.--saida_info').removeAttr('style');
             }, 5000);
        }
      }else{
         $('.--entrada_info').attr('style', 'visibility:visible;opacity:1;');
          setTimeout(function(){
            $('.--entrada_info').removeAttr('style');
         }, 5000);
      }
    }else{
        $('.--destino_info').attr('style', 'visibility:visible;opacity:1;');
          setTimeout(function(){
            $('.--destino_info').removeAttr('style');
         }, 5000);
    }

}

function ver_mais( $roomId ){
	$('#container').html();
	$('.FnBlurEmabassar').attr('style', 'transition: all 0.5s;-webkit-filter: blur(3px);');
 	$('.carregamento').attr('style', 'display:block;');
	 $.ajax({
	    url: base+'/assets/ajax/vermais.ajax.php',
	    type: 'POST',
	    data: { roomId: $roomId },
	  }).done(function(data) {
	 		$('#container').html(data);
	 		$('.FnBlurEmabassar').removeAttr('style');
	 		$('.carregamento').attr('style', 'display:none;');
	  }).fail(function() {
	  	window.location.reload();
	  });
}

function inicial(){
  window.location.replace(base+'/');
}
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
      	currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { 
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

function verificar_room($roomId){
	if($roomId){
	var entrada_assinar = $('#entrada_assinar').val();
    var saida_assinar = $('#saida_assinar').val();
    var quartos_assinas = $('#quartos_assinas').val();
    if(entrada_assinar && saida_assinar){
    	if(quartos_assinas >= 1 && quartos_assinas <= 10){
		$('.error_entrada').removeAttr('style');
    	$('.error_saida').removeAttr('style');
    	$('.error_pessoas').removeAttr('style');
	    $('.FnBlurEmabassar').attr('style', 'transition: all 0.5s;-webkit-filter: blur(3px);');
 		$('.carregamento').attr('style', 'display:block;');
    	$.ajax({
	    url: base+'/assets/ajax/infoAssinatura.vermais.ajax.php',
	    type: 'POST',
	    data: { roomId: $roomId, entrada: entrada_assinar, saida: saida_assinar, quartos: quartos_assinas },
	  	}).done(function(data) {
	 		$('#containerReturn').html(data);
	 		$('.FnBlurEmabassar').removeAttr('style');
	 		$('.carregamento').attr('style', 'display:none;');
	  	}).fail(function() {
	  	window.location.reload();
	  });
	  }else{
	  	if(quartos_assinas > 10){
	  	$('.error_pessoas').html('Opss... o limite maximo de quartos são 10 pessoas!');
    	$('.error_pessoas').attr('style', 'visibility: visible;opacity: 1;');
	  	}else{
	  	$('.error_pessoas').html('Coloque a quantidade de quartos.');
    	$('.error_pessoas').attr('style', 'visibility: visible;opacity: 1;');
    	}
	  }
    }else{
    	$('.error_entrada').attr('style', 'visibility: visible;opacity: 1;');
    	$('.error_saida').attr('style', 'visibility: visible;opacity: 1;');
    }
}
}
function fazer_checkout($roomId_checkout, $entrada_checkout, $saida_checkout, $quartos_checkout){
	if($roomId_checkout && $entrada_checkout && $saida_checkout && $quartos_checkout){
		$('.error_checkout').removeAttr('style');
		$.ajax({
	    url: base+'/assets/ajax/gerarIdCheckout.vermais.ajax.php',
	    type: 'POST',
	    data: { roomId: $roomId_checkout, entrada: $entrada_checkout, saida: $saida_checkout, quartos: $quartos_checkout },
	  	}).done(function(data) {
	 		window.location.replace(base+'/Checkout/'+data);
	  	}).fail(function() {
	  	window.location.reload();
	  });
	}else{
		$('.error_checkout').attr('style', 'visibility: visible;opacity: 1;');
	}
}
