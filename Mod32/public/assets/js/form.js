console.clear()

// const regForm = document.querySelector('#registration')

// regForm.addEventListener('submit', function (e) {
//   e.preventDefault()
//   const data = new FormData(regForm)
//   for (d of data) console.log(d)

//   const url = '/handler.php'
//   fetch(url, {
//     method: 'POST',
//     cache: 'no-cache',

//     credentials: 'same-origin',
//     headers: {
//       // 'Content-Type': 'application/json',
//       'Content-Type': 'application/x-www-form-urlencoded',
//       // 'Content-Type': 'multipart/form-data',
//       // 'Content-Type': 'text/plain',
//     },
//     redirect: 'follow', // manual, *follow, error
//     referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
//     body: JSON.stringify(data), // body data type must match "Content-Type" header
//   })
//     .then(response => {
//       return response.json()
//     })
//     .then(success => {
//       console.log('success', success)
//     })

//     .then(
//       swal({
//         title: 'Отлично!',
//         text: 'Пользователь успешно зарегистрирован!',
//         icon: 'success',
//       }).then(() => {
//         location.reload()
//       })
//     )
//     .catch(error => {
//       const errors = error
//       console.log(error, errors)
//       if (errors.errors) {
//         errors.forEach(function (data, index) {
//           const field = Object.getOwnPropertyNames(data)
//           const value = data[field]
//           const div = document.createElement('div')
//           div.classList.add('error')
//           // div.children.classList
//           console.log(div.children.classList)
//           const div = $('#' + field[0]).closest('div')
//           div.addClass('has-danger')
//           div.children('.form-control-feedback').text(value)
//         })
//       }
//     })

// })

$('#registration').submit(function (e) {
  e.preventDefault()
  var data = new FormData(this)
  // console.log(data)
  $.ajax({
    type: 'POST',
    url: '/handler.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      swal({
        title: 'Отлично!',
        text: 'Пользователь успешно зарегистрирован!',
        icon: 'success',
      }).then(() => {
        window.location.href = '?page=1'
      })
    },
    error: function (response, status, error) {
      var errors = response.responseJSON

      if (errors.errors) {
        errors.errors.forEach(function (data, index) {
          var field = Object.getOwnPropertyNames(data)
          var value = data[field]
          var div = $('#' + field[0]).closest('div')
          div.addClass('has-danger')
          div.children('.form-control-feedback').text(value)
        })
      }
    },
  })
})
