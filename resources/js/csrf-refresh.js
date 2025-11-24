// Auto-refresh CSRF token to prevent 419 errors
document.addEventListener('DOMContentLoaded', function() {
    // Refresh CSRF token every 110 minutes (before session expires at 120 minutes)
    setInterval(function() {
        fetch('/csrf-token', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update all CSRF token inputs
            document.querySelectorAll('input[name="_token"]').forEach(input => {
                input.value = data.csrf_token;
            });
            
            // Update meta tag if exists
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (metaTag) {
                metaTag.setAttribute('content', data.csrf_token);
            }
        })
        .catch(error => {
            console.log('CSRF token refresh failed:', error);
        });
    }, 110 * 60 * 1000); // 110 minutes
});

// Handle form submissions with expired CSRF tokens
document.addEventListener('submit', function(e) {
    const form = e.target;
    if (form.method.toLowerCase() === 'post') {
        e.preventDefault();
        
        // First try to submit normally
        submitForm(form);
    }
});

function submitForm(form) {
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: form.method,
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => {
        if (response.status === 419) {
            // Token expired, get new token and retry
            return refreshTokenAndRetry(form, formData);
        } else if (response.ok) {
            // Successful submission, redirect or reload
            window.location.href = response.url || form.action.replace(/\/(store|update)$/, '');
        } else {
            // Other error, reload page to show validation errors
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Form submission error:', error);
        // Fallback: normal form submission
        form.submit();
    });
}

function refreshTokenAndRetry(form, formData) {
    fetch('/csrf-token', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update form token
        formData.set('_token', data.csrf_token);
        
        // Retry submission
        return fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
    })
    .then(response => {
        if (response.ok) {
            window.location.href = response.url || form.action.replace(/\/(store|update)$/, '');
        } else {
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Token refresh and retry failed:', error);
        form.submit(); // Fallback to normal submission
    });
}
