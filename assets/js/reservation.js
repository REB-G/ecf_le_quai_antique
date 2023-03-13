
// Je veux :
// - récupérer les données du formulaire
const watchSubmit = () => {
    const form = document.querySelector('.js-reservation-submit form')
    form.addEventListener('submit', (event) => {
        event.preventDefault()
        const formData = new FormData(form)
        backCall(formData)
    })
}

// - les envoyer à mon back
const backCall = (dataToSend) => {
    console.log('dataToSend', dataToSend)
    fetch('https://127.0.0.1:8000/reservationAPI', {
        method: "POST",
        body: dataToSend})
    .then((response) => response.json())
    .then((data) => {
        console.log('data', data)
    })
}
//problème fonction asymchrone ? Erreur 'Object of class App\Controller\ReservationController could not be converted to string'
//lors d'essai de récupération d'une donnée en particulier avant de vérifier le formulaire avec par exmeple : 
//$numberOfGuests = $form->$this->getNumberOfGuests();
//dd($numberOfGuests);
//et dans la console, erreurs :
//POST https://127.0.0.1:8000/reservationAPI 500   reservation:98
// window.fetch @ reservation:98
// s @ app.605e24f7.js:1
// (anonyme) @ app.605e24f7.js:1
//
// VM455:1 Uncaught (in promise) SyntaxError: Unexpected token '<', "<!-- Objec"... is not valid JSON
// Promise.then (asynchrone)
// s @ app.605e24f7.js:1
// (anonyme) @ app.605e24f7.js:1

watchSubmit()
