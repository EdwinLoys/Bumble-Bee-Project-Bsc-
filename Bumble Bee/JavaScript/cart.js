const navToggle= document.querySelector('.button-cart')
const closeCart = document.querySelector('.cart-close')

navToggle.addEventListener('click' ,() =>{
  document.body.classList.add('nav-is-open')


})

closeCart.addEventListener('click' ,() =>{
  document.body.classList.remove('nav-is-open')
})
