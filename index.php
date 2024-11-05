<?php
   include ('db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Pet</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="images/logo.png" alt="Logo" class="logo-image">
            </div>
            <ul class="menu">
                <li><a href="#home">Home</a></li>
                <li><a id="petAddBtn" href="#">Add Pets</a></li>
                <li><a href="#pets">Pets</a></li>
                <li><a href="#features">Help</a></li>
                <li><a href="#statistics">About Us</a></li>
                <li><a href="#footer-content">Contact</a></li>
            </ul>
        </nav>
        <div class="hero">
            <div class="hero-content">
                <h1>Find your pet</h1>
                <p>In our shelter, there are several pets waiting for a loving family and a home. Please help them to find a new family, who will love them!</p>
                <button class="adopt-btn" id="adoptBtn">Let's Adopt</button>
            </div>
            <img src="images/hero.webp" alt="A beautiful pet looking into the distance" class="hero-image">
        </div>        
    </header>

    <div class="modal" id="addPetForm" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" id="closePetAddModal">&times;</span>
        <h2>Add Pet Details</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="petId" name="petId">
            <label for="petName">Pet Name:</label>
            <input type="text" id="petName" name="petName" required>

            <label for="petBreed">Breed:</label>
            <input type="text" id="petBreed" name="petBreed" required>

            <label for="petDescription">Description:</label>
            <textarea id="petDescription" name="petDescription" required rows="7" cols="46"></textarea>

            <label for="petImage">Image:</label>
            <input type="file" id="petImage" name="petImage" required>

            <input class="adopt-btn" type="submit" name="addPet" value="Save">
        </form>
    </div>
</div>


    <div class="modal" id="adoptionForm" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Adopt a Pet</h2>
            <form action="" method="post" >
                <input type="hidden" id="adoptId" name="adoptId">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="pet">Pet's Name:</label>
                <input type="text" id="pet" name="pet" required>
                <input class="adopt-btn" type="submit" name="addAdoption" value="Submit" >
            </form>
        </div>
    </div>    
    
    <div class="modal" id="volunteerForm" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" id="closeVolunteerModal">&times;</span>
            <h2>Be a Volunteer</h2>
            <form action="" method="post">
                <input type="hidden" id="volunteerId" name="volunteerId">
                <label for="volunteerName">Your Name:</label>
                <input type="text" id="volunteerName" name="volunteerName" required>
                <label for="volunteerEmail">Email:</label>
                <input type="email" id="volunteerEmail" name="volunteerEmail" required>
                <label for="volunteerPhone">Phone Number:</label>
                <input type="tel" id="volunteerPhone" name="volunteerPhone" required>
                <label for="volunteerMsg">Message:</label>
                <textarea style="margin-bottom: 10px;" id="volunteerMsg" name="volunteerMsg" rows="4" cols="46"></textarea>
                <input class="adopt-btn" type="submit" name="addVolunteer" value="Submit"/>
            </form>
        </div>
    </div>

    <div class="modal" id="donationForm" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" id="closeDonationModal">&times;</span>
            <h2>Donate for Them</h2>
            <form action="" method="post" >
                <input type="hidden" id="donateId" name="donateId">
                <label for="donorName">Your Name:</label>
                <input type="text" id="donorName" name="donorName" required>
                <label for="donorEmail">Email:</label>
                <input type="email" id="donorEmail" name="donorEmail" required>
                <label for="donationAmount">Donation Amount:</label>
                <input type="number" id="donationAmount" name="donationAmount" required min="1" step="0.01">
                <label for="donationMessage">Message:</label>
                <textarea style="margin-bottom: 10px;" id="donationMessage" name="donationMessage" rows="4" cols="46"></textarea>
                <input class="adopt-btn" type="submit" name="addDonation" value="Donate">
            </form>
        </div>
    </div>

    <div class="modal" id="petDetailModal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" id="closePetDetailModal">&times;</span>
        <img style="display: block; margin: 0 auto;" id="petDetailImage" src="" alt="Pet Detail">
        <h2 id="petDetailName">Pet Name</h2>
        <p style="margin-bottom: 10px; font-weight: bold;" id="petDetailBreed">Breed:</p>
        <p style="margin-bottom: 10px; text-align: justify;" id="petDetailDescription">Description:</p>
        <button class="adopt-btn" id="adoptPetBtn" type="submit">Adopt</button>
    </div>
</div>

    <section class="features" id="features">
          <div class="feature-card" id="adoptCard">
            <img src="images/adopt.png" alt="Adopt Icon"><br>
            Adopt a pet
          </div>   
        <div class="feature-card" id="volunteerCard">
            <img src="images/volunteer.png" alt="Volunteer Icon"><br>
            Be a volunteer
        </div>
        <div class="feature-card" id="donateCard">
            <img src="images/donate.png" alt="Donate Icon"><br>
            Donate for them
        </div>
    </section>

    <section class="pets" id="pets">
    <h2>Who are waiting for you?</h2>
    <div class="pet-cards" id="petCardsContainer">
        <?php
        $select_pets = "SELECT * FROM pets";
        $result_pets = mysqli_query($conn, $select_pets);
        while ($row = mysqli_fetch_assoc($result_pets)) {
            $id = $row['id'];
            $name = $row['name'];
            $breed = $row['breed'];
            $description = $row['description'];
            $image = $row['image'];

            echo "<div class='pet-card' data-pet-id='$id'>
                    <img src='./images/$image'>
                    <p>$name</p>
                  </div>";
        }
        ?>
    </div>
    <button id="scrollLeftBtn" class="scroll-btn">←</button>
    <button id="scrollRightBtn" class="scroll-btn">→</button>
</section>

<?php

// Count dogs based on breed or name containing "dog-related" keywords
$dog_count_query = "SELECT COUNT(*) as count FROM pets WHERE description LIKE '%dog%'";
$dog_count_result = mysqli_query($conn, $dog_count_query);
$dog_count_row = mysqli_fetch_assoc($dog_count_result);
$dog_count = $dog_count_row['count'];

// Count cats based on breed or name containing "cat-related" keywords
$cat_count_query = "SELECT COUNT(*) as count FROM pets WHERE description LIKE '%cat%'";
$cat_count_result = mysqli_query($conn, $cat_count_query);
$cat_count_row = mysqli_fetch_assoc($cat_count_result);
$cat_count = $cat_count_row['count'];


?>

    <section class="statistics" id="statistics">
        <h2>Our statistics</h2>
        <div class="stat-cards">
            <div class="stat-card">
                <img src="images/dogs.jpg" alt="Dog Icon" class="card-img">
                <p style="font-size: 20px;"><b><?php echo $dog_count; ?></b></p>
                <p>dogs</p>
            </div>
            <div class="stat-card">
                <img src="images/cats.jpg" alt="Cat Icon">
                <p style="font-size: 20px;"><b><?php echo $cat_count; ?></b></p> 
                <p>cats</p>
            </div>
            <div class="stat-card">
                <img src="images/dg-house.png" alt="Capacity Icon">
                <p style="font-size: 20px;"><b>77</b></p>
                <p>capacity</p> 
            </div>
            <div class="stat-card">
                <img src="images/house.jpg" alt="Adopted Icon">
                 <p style="font-size: 20px;"><b>231</b></p>
                 <p>adopted</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content" id="footer-content">
            <div class="address">
                <h3>Address</h3>
                <p>Dewalapola, Minuwangoda, 11550, Sri Lanka</p>
            </div>
            <div class="contact">
                <h3>Contact</h3>
                <p>Email: pets@caring.com</p>
                <p>Phone: +123456789</p>
            </div>
            <div class="supporters">
                <h3>Supporters</h3>
                <p>Mr. Anura Kadagoda</p>
                <p>Mrs. Dulani Weerasinghe</p>
                <p>Mr. Priyantha Gamage</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>

<?php

// Add pet
if (isset($_POST['addPet'])) {
    $petId = $_POST['petId'];
    $petName = $_POST['petName'];
    $petBreed = $_POST['petBreed'];
    $petDescription = $_POST['petDescription'];
    $petImage=$_FILES['petImage']['name'];
    $petImage_tmp=$_FILES['petImage']['tmp_name'];


        // Select pet
        $select_sql = "SELECT * FROM pets WHERE name='$petName'";
        $result = mysqli_query($conn,$select_sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
            echo "<script>alert('Pet name already exist!')</script>";
        }
        else{
        // Insert new pet
        move_uploaded_file($petImage_tmp, "./images/" . $petImage);
        $sql = "INSERT INTO pets (name, breed, description, image) VALUES ('$petName', '$petBreed', '$petDescription', '$petImage')";
        $sql_execute=mysqli_query($conn,$sql);
       if($sql_execute){
        echo "<script>alert('Pet Added Successfully')</script>";
        }
        else{
        die(mysqli_error($conn));
        }
    }
}

// Do Adoption
if (isset($_POST['addAdoption'])) {
    $adoptId = $_POST['adoptId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pet = $_POST['pet'];

        // Select adoption
        $select_adopt = "SELECT * FROM adoptions WHERE petName='$pet'";
        $result = mysqli_query($conn,$select_adopt);
        $count = mysqli_num_rows($result);
        if($count > 0){
            echo "<script>alert('It's already adopted!')</script>";
        }
        else{
        // Insert new adoption
        $insert_sql = "INSERT INTO adoptions (name, email, petName) VALUES ('$name', '$email', '$pet')";
        $adoption_result=mysqli_query($conn,$insert_sql);
        if ($adoption_result) {
            // Delete the pet from 'pets' table
            $delete_pet = "DELETE FROM pets WHERE name = '$pet'";
            $delete_result = mysqli_query($conn, $delete_pet);
    
            if ($delete_result) {
                echo "<script>alert('Adoption successful!');</script>";
            } else {
                echo "<script>alert('Failed to remove pet from list');</script>";
            }
        } else {
            echo "<script>alert('Failed to add adoption record');</script>";
        }
    }
}

// Add volunteer
if (isset($_POST['addVolunteer'])) {
    $volunteerId = $_POST['volunteerId'];
    $volunteerName = $_POST['volunteerName'];
    $volunteerEmail = $_POST['volunteerEmail'];
    $volunteerPhone = $_POST['volunteerPhone'];
    $volunteerMsg = $_POST['volunteerMsg'];


        // Select volunteer
        $select_volunteer = "SELECT * FROM volunteers WHERE name='$volunteerName'";
        $result = mysqli_query($conn,$select_volunteer);
        $count = mysqli_num_rows($result);
        if($count > 0){
            echo "<script>alert('Volunteer name already exist!')</script>";
        }
        else{
        // Insert new volunteer
        $insert_sql = "INSERT INTO volunteers (name, email, phone, message) VALUES ('$volunteerName', '$volunteerEmail', '$volunteerPhone', '$volunteerMsg')";
        $sql_execute=mysqli_query($conn,$insert_sql);
       if($sql_execute){
        echo "<script>alert('Volunteer Added Successfully')</script>";
        }
        else{
        die(mysqli_error($conn));
        }
    }
}

// Add donation
if (isset($_POST['addDonation'])) {
    $donateId = $_POST['donateId'];
    $donorName = $_POST['donorName'];
    $donorEmail = $_POST['donorEmail'];
    $donationAmount = $_POST['donationAmount'];
    $donationMessage = $_POST['donationMessage'];


        // Select volunteer
        $select_donate = "SELECT * FROM donations WHERE name='$donorName'";
        $result = mysqli_query($conn,$select_donate);
        $count = mysqli_num_rows($result);
        // Insert new volunteer
        $insert_sql = "INSERT INTO donations (name, email, amount, message) VALUES ('$donorName', '$donorEmail', '$donationAmount', '$donationMessage')";
        $sql_execute=mysqli_query($conn,$insert_sql);
       if($sql_execute){
        echo "<script>alert('Donation Added Successfully')</script>";
        }
        else{
        die(mysqli_error($conn));
        }
}

// Delete pet
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $petId = $_DELETE['petId'];

    $sql = "DELETE FROM pets WHERE id=$petId";
    if ($conn->query($sql) === TRUE) {
        echo "Deleted";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>




