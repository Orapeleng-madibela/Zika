document.addEventListener('DOMContentLoaded', function() {
    const toggleDetailsBtn = document.getElementById('toggle-details-btn');
    const details = document.getElementById('details');
    const rsvpForm = document.getElementById('rsvp-form');
    const confirmationMessage = document.getElementById('confirmation-message');

    toggleDetailsBtn.addEventListener('click', function() {
        if (details.classList.contains('details-hidden')) {
            details.classList.remove('details-hidden');
            toggleDetailsBtn.textContent = 'Hide Details';
        } else {
            details.classList.add('details-hidden');
            toggleDetailsBtn.textContent = 'Show Details';
        }
    });

    rsvpForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();

        if (name && phone) {
            fetch('rsvp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `name=${encodeURIComponent(name)}&phone=${encodeURIComponent(phone)}&email=${encodeURIComponent(email)}`,
            })
            .then(response => response.text())
            .then(data => {
                confirmationMessage.textContent = `Thank you, ${name}, for your RSVP!`;
                confirmationMessage.classList.remove('confirmation-hidden');
                rsvpForm.reset();
            })
            .catch(error => {
                alert('There was a problem with your RSVP. Please try again.');
            });
        } else {
            alert('Please fill out the required fields.');
        }
    });
});
