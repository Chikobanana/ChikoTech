document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            
            // Create loading indicator
            const submitButton = contactForm.querySelector('.form-submit');
            const originalButtonText = submitButton.textContent;
            submitButton.textContent = 'Sending...';
            submitButton.disabled = true;
            
            // Send AJAX request
            fetch('contact-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Display response message
                const messageElement = document.createElement('div');
                messageElement.className = data.status === 'success' ? 'alert-success' : 'alert-error';
                messageElement.textContent = data.message;
                
                // Insert message above the form
                contactForm.parentNode.insertBefore(messageElement, contactForm);
                
                // Reset form if successful
                if (data.status === 'success') {
                    contactForm.reset();
                }
                
                // Remove message after 5 seconds
                setTimeout(() => {
                    messageElement.remove();
                }, 5000);
                
                // Reset button
                submitButton.textContent = originalButtonText;
                submitButton.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Display error message
                const messageElement = document.createElement('div');
                messageElement.className = 'alert-error';
                messageElement.textContent = 'An error occurred. Please try again later.';
                
                // Insert message above the form
                contactForm.parentNode.insertBefore(messageElement, contactForm);
                
                // Remove message after 5 seconds
                setTimeout(() => {
                    messageElement.remove();
                }, 5000);
                
                // Reset button
                submitButton.textContent = originalButtonText;
                submitButton.disabled = false;
            });
        });
    }
});