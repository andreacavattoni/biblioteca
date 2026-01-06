(function($){
  $(document).ready(function(){
    $('.menu-item-has-children > a').on('click', function(e){
      if(!$(this).hasClass('open')){
        e.preventDefault();
        $(this).addClass('open');
        $('#header').addClass('dark');
        $('.menu-item-has-children .sub-menu').css('display','flex');
        $('.menu-item-has-children .sub-menu').addClass('open');
      }
      else{
        $(this).removeClass('open');
        $('.menu-item-has-children .sub-menu').removeClass('open');
        $('#header').removeClass('dark');

        setTimeout(function(){
          $('.menu-item-has-children .sub-menu').css('display','flex');
        },350)
      }

    })
    if($('.progetti-grid').length > 0){
    $('.progetti-grid').flickity({
      imagesLoaded:true,
      prevNextButtons:true,
      pageDots:true
    })
  }
  if($('.home-books').length > 0){
  $('.home-books').flickity({
    imagesLoaded:true,
    prevNextButtons:false,
    pageDots:false
  })
}
  })
})(jQuery);
