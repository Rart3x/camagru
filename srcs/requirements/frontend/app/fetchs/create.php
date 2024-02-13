fetch('http:localhost:3000/api/user/create')
    .then(response => response.json())
    .then(data => console.log(data));
