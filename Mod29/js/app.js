console.clear()

function random(number) {
  return Math.floor(Math.random() * (number + 1))
}

function quoteHandler() {
  const quotes = document.querySelectorAll('.quote')
  const idx = random(quotes.length - 1)

  quotes.forEach(quote => quote.classList.add('hidden'))

  quotes[idx].classList.remove('hidden')
  quotes[idx].classList.add('visible')
}
quoteHandler()

function year() {
  const year = document.querySelector('.year')
  year.innerText = new Date().getFullYear()
}

year()
