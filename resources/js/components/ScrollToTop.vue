<template>
  <div>
      <a id="scrollToTop"></a>
  </div>


</template>

<script>
  let btn = $('#scrollToTop');

  $(window).scroll(function() {
    if($(window).scrollTop() > 300) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });

export default {

}
</script>

<style>
#scrollToTop {
display: inline-block;
background-color: #FF9800;
width: 50px;
height: 50px;
text-align: center;
border-radius: 4px;
position: fixed;
bottom: 30px;
right: 30px;
transition: background-color .3s,
  opacity .5s, visibility .5s;
opacity: 0;
visibility: hidden;
z-index: 1000;
}
#scrollToTop::after {
content: "\f077";
font-family: FontAwesome;
font-weight: normal;
font-style: normal;
font-size: 2em;
line-height: 50px;
color: #fff;
}
#scrollToTop:hover {
cursor: pointer;
background-color: #333;
}
#scrollToTop:active {
background-color: #555;
}
#scrollToTop.show {
opacity: 1;
visibility: visible;
}

</style>
