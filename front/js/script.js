function myfunction(){
    var x = document.getElementById("menubox");
    x.classList.toggle("change");
   }

function myffunction() {
    var x = document.getElementById("menulightbox");
    if (x.style.display === "block") {
       x.style.display = "none";
      } 
else {
      x.style.display = "block";
    }
    myfunction();
}

$(document).ready(function(){
  $("#more a").click(function(){
    $("#more").css("display", "none");
    $("#less").css("display", "block");
    $(".abt-content").css("height", "100%");
  });
  
   $("#less a").click(function(){
    $("#less").css("display", "none");
    $("#more").css("display", "block");
    $(".abt-content").css("height", "190px");
  });
});

$(document).ready(function(){
  $("#open").click(function(){
    $("#open").css("display", "none");
    $("#close").css("display", "block");
    $(".home-nav").css("opacity", "0");
    $("#menulightbox").css("transform", "translateY(0%)");
    
  });
  
   $("#close").click(function(){
    $("#close").css("display", "none");
    $("#open").css("display", "block");
    $(".home-nav").css("opacity", "1");
    $("#menulightbox").css("transform", "translateY(-100%)");
  });

  $('.slick-review').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    arrows:false,
    adaptiveHeight: true,
    prevArrow:"<i class='fa fa-angle-left' aria-hidden='true'></i>",
    nextArrow:"<i class='fa fa-angle-right' aria-hidden='true'></i>"
  });
});

$(document).ready(function(){
  $("#view-gall").click(function(){
    $("#g-cruise").css("height", "100%");
    $("#view-gall").css("display", "none");
     $(".gradient").css("display", "none");
     $("#g-cruise").css("margin-bottom", "40px");
  });
  

});

// Références aux éléments importants
let sliderContainer = document.querySelector('.slider-container');
let slider = document.querySelector('.slider-items');
let items = slider.querySelectorAll('.slider-item');

// Variables globales
let initialDragOffset;
let currentDragOffset;

// Écouteur délégué des événements de clic
document.querySelector('.slider-arrows').addEventListener('click', (event) => {
  let clickEventPath = event.composedPath().slice(0, -2);
  
  console.log("Coucou");
  
  for (let element of clickEventPath) {
    if ('previous' in element.dataset) {
      previousSlideClickHandler(element, sliderContainer);
      break;
    } else if ('next' in element.dataset) {
      nextSlideClickHandler(element, sliderContainer);
      break;
    }
  }
});

// Gestionnaire du bouton précédent
function previousSlideClickHandler(element, section) {
  scrollToSlide('previous');
}

// Gestionnaire du bouton suivant
function nextSlideClickHandler(element, section) {
  scrollToSlide('next');
}

// Écouteur d'événements liés au drag du slider
sliderContainer.addEventListener('mousedown', (event) => desktopScrollMouseDownHandler(event));

document.addEventListener('mousemove', (event) => desktopScrollMouseMoveHandler(event));

document.addEventListener('mouseup', (event) => desktopScrollMouseUpHandler(event));

// Gestionnaire de l'initiation d'un drag slider
function desktopScrollMouseDownHandler(event) {
  if (event.target.classList.contains('slider-arrow')) return false;
  
  event.preventDefault();
  
  document.querySelector('body').setAttribute('data-sliding', '');
  
  initialDragOffset = event.clientX - sliderContainer.offsetLeft;
}

// Gestionnaire du drag slider
function desktopScrollMouseMoveHandler(event) {
 if (!document.querySelector('body').hasAttribute('data-sliding')) return false;
  
  currentDragOffset = event.clientX;
  
  let sliderScrollOffset = slider.scrollLeft;
  let nextSliderOffset = sliderScrollOffset - (currentDragOffset - initialDragOffset);
  
  slider.scroll({ left: nextSliderOffset, behavior: 'auto' });
  
  initialDragOffset = currentDragOffset;
}

// Gestionnaire de la fin d'un drag slider
async function desktopScrollMouseUpHandler(event) {
  if (!document.querySelector('body').hasAttribute('data-sliding')) return false;
  
  document.querySelector('body').removeAttribute('data-sliding');
  
  slider.style.scrollSnapType = "none";
  
  scrollToSlide();
  
  setTimeout(() => slider.style.scrollSnapType = null, 800)
}

// Gestionnaire du scroll
function scrollToSlide(command) {
  let numberOfItems = items.length;
  let itemWidth = items[0].offsetWidth;
  let sliderGap = parseInt(window.getComputedStyle(slider).rowGap);
  let numberOfItemsOnScreen = parseFloat((window.innerWidth / (itemWidth + sliderGap)).toFixed(2));
  let sliderScrollOffset = slider.scrollLeft;
  let activeItemIndex = Math.ceil(sliderScrollOffset / (itemWidth + sliderGap));
  let nextItemIndex;
  
  switch(command) {
    case 'previous':
      nextItemIndex = activeItemIndex - 1;      
      if (nextItemIndex < 0) {
        nextItemIndex = numberOfItems - Math.floor(numberOfItemsOnScreen);
      }
      break;
    case 'next':
      nextItemIndex = activeItemIndex + 1;
      if (nextItemIndex > numberOfItems - Math.floor(numberOfItemsOnScreen)) {
        nextItemIndex = 0;
      }
      break;
    default:
      nextItemIndex = Math.floor(sliderScrollOffset / (itemWidth + sliderGap));
  }
    
  let nextSliderOffset = nextItemIndex * (itemWidth + sliderGap);
  
  slider.scroll({ left: nextSliderOffset, behavior: 'smooth' });
}

