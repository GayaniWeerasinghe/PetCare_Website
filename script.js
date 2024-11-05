
// Smooth scrolling for menu links
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1); // Get the target ID from href
        document.getElementById(targetId)?.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Scroll to top button functionality
const scrollTopBtn = document.createElement('button');
scrollTopBtn.innerHTML = '↑';
scrollTopBtn.classList.add('scroll-top-btn');
document.body.appendChild(scrollTopBtn);

scrollTopBtn.style.display = 'none';
scrollTopBtn.style.position = 'fixed';
scrollTopBtn.style.bottom = '20px';
scrollTopBtn.style.right = '20px';
scrollTopBtn.style.padding = '10px 15px';
scrollTopBtn.style.background = '#6dbf57';
scrollTopBtn.style.color = '#fff';
scrollTopBtn.style.border = 'none';
scrollTopBtn.style.borderRadius = '50%';
scrollTopBtn.style.cursor = 'pointer';

window.addEventListener('scroll', () => {
    scrollTopBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
});

scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Function to close modal when clicking outside of it
function closeModalOnClickOutside(modalId) {
    window.onclick = function(event) {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
}

// Add pets form modal handling
document.getElementById('petAddBtn').addEventListener('click', function() {
    document.getElementById('addPetForm').style.display = 'flex';
});

document.getElementById('closePetAddModal').addEventListener('click', function() {
    document.getElementById('addPetForm').style.display = 'none';
});

// Adoption form modal handling
document.querySelector('.adopt-btn').addEventListener('click', function() {
    document.getElementById('adoptionForm').style.display = 'flex';
});

document.getElementById('adoptCard').addEventListener('click', function() {
    document.getElementById('adoptionForm').style.display = 'flex';
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('adoptionForm').style.display = 'none';
});

// Volunteer form modal handling
document.getElementById('volunteerCard').addEventListener('click', function() {
    document.getElementById('volunteerForm').style.display = 'flex';
});

document.getElementById('closeVolunteerModal').addEventListener('click', function() {
    document.getElementById('volunteerForm').style.display = 'none';
});

// Donation form modal handling
document.getElementById('donateCard').addEventListener('click', function() {
    document.getElementById('donationForm').style.display = 'flex';
});

document.getElementById('closeDonationModal').addEventListener('click', function() {
    document.getElementById('donationForm').style.display = 'none';
});


document.addEventListener('DOMContentLoaded', function() {
    const petCardsContainer = document.getElementById('petCardsContainer');
    const petDetailModal = document.getElementById('petDetailModal');
    const scrollLeftBtn = document.getElementById("scrollLeftBtn");
    const scrollRightBtn = document.getElementById("scrollRightBtn");

    // Scroll the container to the left by 300px when the left button is clicked
    scrollLeftBtn.addEventListener("click", function () {
        petCardsContainer.scrollBy({
            left: -300,
            behavior: "smooth"
        });
    });

    // Scroll the container to the right by 300px when the right button is clicked
    scrollRightBtn.addEventListener("click", function () {
        petCardsContainer.scrollBy({
            left: 300,
            behavior: "smooth"
        });
    });

    // Add click event listener to each pet card
    petCardsContainer.addEventListener('click', function(event) {
        const card = event.target.closest('.pet-card');
        if (card) {
            const petId = card.getAttribute('data-pet-id');

            // Fetch the pet details from the backend using petId
            fetch(`get_pet_details.php?pet_id=${petId}`)
                .then(response => response.json())
                .then(pet => {
                    if (!pet.error) {
                        // Populate modal with pet details
                        document.getElementById('petDetailImage').src = `images/${pet.image}`;
                        document.getElementById('petDetailName').innerText = pet.name;
                        document.getElementById('petDetailBreed').innerText = `Breed: ${pet.breed}`;
                        document.getElementById('petDetailDescription').innerText = pet.description;

                        // Display the pet detail modal
                        petDetailModal.style.display = 'flex';
                    } else {
                        console.error('Error:', pet.error);
                    }
                })
                .catch(error => {
                    console.error('Error fetching pet details:', error);
                });
        }
    });

    // Close the modal when clicking outside or on the close button
    document.getElementById('closePetDetailModal').addEventListener('click', function() {
        petDetailModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === petDetailModal) {
            petDetailModal.style.display = 'none';
        }
    });
});

// Adopt button functionality
document.getElementById('adoptPetBtn').addEventListener('click', function() {
    const petName = document.getElementById('petDetailName').textContent.trim();
    document.getElementById('petDetailModal').style.display = 'none';
    document.getElementById('adoptionForm').style.display = 'flex';
    document.getElementById('pet').value = petName; // Set the pet name in the adoption form
});

// Close the pet detail modal
document.getElementById('closePetDetailModal').addEventListener('click', function() {
    document.getElementById('petDetailModal').style.display = 'none';
});

// Close modal when clicking outside of the pet detail modal
closeModalOnClickOutside('petDetailModal');

// Ensure the adoption form is hidden by default
document.getElementById('adoptionForm').style.display = 'none';