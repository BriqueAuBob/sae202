const areas = document.querySelectorAll('rect');
const departure_address = document.querySelector('#departure_address');

areas.forEach(area => {
    area.addEventListener('click', () => {
        let id = area.getAttribute('id');
        
        departure_address.value = id;
    });
});