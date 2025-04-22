// Function to handle navigation highlighting
/*
function highlightActiveSidebar() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const currentPage = window.location.pathname.split('/').pop();

    sidebarItems.forEach(item => {
        const targetPage = item.getAttribute('onclick').match(/'(.+?)'/)[1];
        if (targetPage === currentPage) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}*/
/*progress bar*/

function updateProgressBar() {
    const steps = document.querySelectorAll('.sidebar-item');
    const activeStep = document.querySelector('.sidebar-item.active');
    const progressBar = document.getElementById('progressBar');

    if (activeStep) {
        const progress = ((Array.from(steps).indexOf(activeStep) + 1) / steps.length) * 100;
        progressBar.style.width = `${progress}%`;
    }
}

document.addEventListener('DOMContentLoaded', updateProgressBar);
window.addEventListener('scroll', updateProgressBar);
// Function to dynamically add skills in the Skills page
function addSkill() {
    const skillInput = document.getElementById('skillInput');
    const skillsList = document.getElementById('skillsList');

    if (skillInput && skillsList && skillInput.value.trim() !== '') {
        const skillItem = document.createElement('li');
        skillItem.className = 'skill-item';
        skillItem.innerHTML = `
            ${skillInput.value}
            <button class="remove-btn" onclick="removeSkill(this)">Remove</button>
        `;
        skillsList.appendChild(skillItem);
        skillInput.value = ''; // Clear the input field
    }
}

// Function to remove a skill from the list
function removeSkill(button) {
    const skillItem = button.parentElement;
    skillItem.remove();
}

// Function to handle the "I'm currently enrolled" checkbox in the Education page
function toggleGraduationDate() {
    const stillEnrolledCheckbox = document.getElementById('stillEnrolled');
    const graduationDateInput = document.getElementById('graduationDate');

    if (stillEnrolledCheckbox && graduationDateInput) {
        graduationDateInput.disabled = stillEnrolledCheckbox.checked;
    }
}

// Initialize dynamic behaviors on page load
document.addEventListener('DOMContentLoaded', () => {
    highlightActiveSidebar();

    const stillEnrolledCheckbox = document.getElementById('stillEnrolled');
    if (stillEnrolledCheckbox) {
        stillEnrolledCheckbox.addEventListener('change', toggleGraduationDate);
    }
});


// Dark Mode BUTTON (IF I CLICK THE BUTTON IT WILL SWITCH TO DARK MODE IF )

// Dark Mode Toggle Function
function toggleDarkMode() {
    const body = document.body;
    const isDarkMode = body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', isDarkMode); // Save preference in localStorage

    // Update button text
    const darkModeButton = document.getElementById('darkModeToggle');
    if (darkModeButton) {
        darkModeButton.textContent = isDarkMode ? 'Light Mode' : 'Dark Mode';
    }
}

// Initialize Dark Mode on Page Load
document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }

    // Create Dark Mode Toggle Button
    let darkModeButton = document.getElementById('darkModeToggle');
    if (!darkModeButton) {
        darkModeButton = document.createElement('button');
        darkModeButton.id = 'darkModeToggle';
        darkModeButton.textContent = isDarkMode ? 'Light Mode' : 'Dark Mode';
        darkModeButton.className = 'dark-mode-toggle';
        document.body.appendChild(darkModeButton);
    }

    // Add Event Listener to the Button
    darkModeButton.addEventListener('click', toggleDarkMode);
});


