<?php
include '../library/include/bootstrap.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width= , initial-scale=1.0">
  <title>Literature Oasis</title>
  <link rel="icon"
    href="https://img.freepik.com/premium-vector/bookish-oasis-student-sitting-books-emblem-literary-retreat-student-chair-with-books-logo_706143-96993.jpg"
    type="image/png">
  <link rel="stylesheet" href="/library/assets/HomePage.css">
</head>

<body style="background-image: linear-gradient(to right, rgba(157, 150, 150, 0.85), rgba(226, 227, 222, 0.75));">

  <!--Navbar-->
  <?php   include('../library/include/navbar.php'); ?>


  <!-- Hero Section -->
  <section class="hero d-flex align-items-center text-center text-white">
    <div class="container">
      <h1 class="display-1 fw-bold py-5">Welcome to Literature Oasis</h1>
      <p class="lead">
        Discover a world of books, manage your collection, and keep track of your reading journey with ease.
      </p>
    </div>
  </section>


  <!--Feature Books-->
  <section class="book-section">
    <div class="container">
      <h2 class="text-center display-6 section-title">Featured Collection</h2>
      <div class="row g-5">


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://www.hachettebookgroup.com/wp-content/uploads/2022/03/9781594835551-1.jpg"
                class="book-img" alt="The Great Gatsby">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">The Great Gatsby</h5>
              <p class="book-author">F. Scott Fitzgerald</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/71QlyxnQrDL._UF894,1000_QL80_.jpg" class="book-img"
                alt="Pride and Prejudice">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">Pride and Prejudice</h5>
              <p class="book-author">Jane Austen</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div>
                <!-- <div class="book-price">$12.99</div> -->
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/61NAx5pd6XL.jpg" class="book-img" alt="1984">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">1984</h5>
              <p class="book-author">George Orwell</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                </div>
                <!-- <div class="book-price">$13.50</div> -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/61tdfXv+VqL._SY342_.jpg" class="book-img" alt="1984">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">SQL All-In-One for Dummies, 3ed</h5>
              <p class="book-author">Allen G. Taylor</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                </div>
                <!-- <div class="book-price">$13.50</div> -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/61-6TTTBZeL._SY342_.jpg" class="book-img" alt="1984">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">Artificial Intelligence: A Modern Approach</h5>
              <p class="book-author"> Russell/Norvig</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                </div>
                <!-- <div class="book-price">$13.50</div> -->
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img
                src="https://cdn.britannica.com/21/182021-050-666DB6B1/book-cover-To-Kill-a-Mockingbird-many-1961.jpg"
                class="book-img" alt="To Kill a Mockingbird">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">To Kill a Mockingbird</h5>
              <p class="book-author">Harper Lee</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                </div>
                <!-- <div class="book-price">$15.25</div> -->
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/61sHHyZDoDL._SY342_.jpg" class="book-img" alt="img">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">Advanced Machine Learning: Fundamentals and algorithms</h5>
              <p class="book-author">Amit Tyagi</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div>
                <!-- <div class="book-price">$16.99</div> -->
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-3 col-sm-6">
          <div class="card book-card h-100">
            <div class="book-img-container">
              <img src="https://m.media-amazon.com/images/I/61ZdDyPBSUL._SY385_.jpg" class="book-img" alt="Moby Dick">
              <div class="book-overlay">
                <button class="book-btn">Quick View</button>
              </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <h5 class="book-title">Cryptography and Cryptanalysis in MATLAB</h5>
              <p class="book-author">Marius Iulian Mihailescu<br>Stefania Loredana Nita</p>
              <div class="book-meta">
                <div class="book-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                </div>
                <!-- <div class="book-price">$11.75</div> -->
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="text-center mt-5">
        <button class="see-more-btn">See More Books <i class="bi bi-arrow-right"></i></button>
      </div>
    </div>
  </section>


  <!-- Reserve a Table Section -->
  <div class="container-fluid">
    <section class="reserve-section">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8">
            <h2 class="reserve-title">Reserve Your Study Table</h2>
            <p class="reserve-description py-4 fs-6">
              Need a quiet space to focus? Reserve your study table online and make your time in the library more
              productive.
            </p>
            <a href="reserve.php" class="btn reserve-btn mb-5 text-white">
              Reserve a Table
            </a>
          </div>
        </div>

        <div class="row justify-content-center mt-4">
          <div class="col-12 col-md-10">
            <div class="row g-4">
              <div class="col-12 col-md-4">
                <div class="feature">
                  <i class="fas fa-clock"></i>
                  <span class="feature-text">24/7 Online Reservation</span>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="feature">
                  <i class="fas fa-users"></i>
                  <span class="feature-text">Group & Individual Spaces</span>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="feature">
                  <i class="fas fa-bolt"></i>
                  <span class="feature-text">Power Outlets Included</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!--About Us-->
  <section class="about-section py-5">

    <div class="container about-content py-5">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 order-md-2 mb-5 mb-lg-0 ">
          <img src="https://images.pexels.com/photos/9158506/pexels-photo-9158506.jpeg" alt="Modern Library"
            class="about-img img-fluid">
        </div>

        <div class="col-lg-6 order-md-1">
          <h1 class="section2-title display-4 fw-bold">About Our Library</h1>

          <p class="lead-text fst-italic">
            Knowledge connects us. Explore our collection, discover new resources, and let's learn together. Ready to
            begin your journey?
          </p>

          <div class="mb-4">
            <p>At Literature Oasis, we believe that access to knowledge should be easy, organized, and available to
              everyone—whether you're a student, researcher, or casual reader. Our mission is to provide a seamless
              library management system that connects our community with the resources they need.</p>

            <p>From digital archives to physical collections, we've built a system that makes finding, borrowing, and
              returning materials effortless. But what truly sets us apart is our commitment to creating a welcoming
              space for learning and discovery.</p>
          </div>

          <div class="stats-container">
            <div class="row text-center g-5">
              <div class="col-4 stat-item">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">Books</div>
              </div>
              <div class="col-4 stat-item">
                <div class="stat-number mx-2">5,000+</div>
                <div class="stat-label">Members</div>
              </div>
              <div class="col-4 stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Access</div>
              </div>
            </div>
          </div>

          <ul class="feature-list">
            <li><i class="fas fa-check-circle"></i> Digital catalog with advanced search capabilities</li>
            <li><i class="fas fa-check-circle"></i> Online reservation system for study spaces</li>
            <li><i class="fas fa-check-circle"></i> Automated reminders for due dates</li>
            <li><i class="fas fa-check-circle"></i> Community events and workshops</li>
          </ul>

          <a href="#" class="btn btn-library mt-3">Explore Our Services</a>
        </div>
      </div>
    </div>
  </section>

  <!--Upcoming Events-->
  <section class="events-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-titl display-6">Upcoming Events & Workshops</h2>
        <p class="section-subtitle">Join our community activities and enhance your knowledge and skills</p>
      </div>

      <div class="row">
        <!-- Event 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-card">
            <div class="event-img">
              <img
                src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80"
                alt="Author Talk">
              <div class="event-date">
                 <?php
                     $randomDays = rand(1, 30);
                     $futureDate = date('M j, Y', strtotime("+$randomDays days"));
                     echo $futureDate;
                   ?>
              </div>
              <div class="event-category">Author Talk</div>
            </div>
            <div class="event-content">
              <h3 class="event-title">Meet the Authors Series</h3>
              <div class="event-details">
                <p><i class="fas fa-clock"></i> 4:00 PM - 6:00 PM</p>
                <p><i class="fas fa-map-marker-alt"></i> Main Reading Room</p>
              </div>
              <p class="event-description">Join us for an evening with acclaimed local authors as they discuss their
                latest works and creative process.</p>
              <button class="event-btn">Join Here <i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- Event 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-card">
            <div class="event-img">
              <img
                src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80"
                alt="Book Club">
              <div class="event-date">
                <?php
                   $randomDays = rand(1, 30);
                   $futureDate = date('M j, Y', strtotime("+$randomDays days"));
                   echo $futureDate;
                 ?>
              </div>
              <div class="event-category">Book Club</div>
            </div>
            <div class="event-content">
              <h3 class="event-title">Science Fiction Book Club</h3>
              <div class="event-details">
                <p><i class="fas fa-clock"></i> 6:30 PM - 8:00 PM</p>
                <p><i class="fas fa-map-marker-alt"></i> Conference Room B</p>
              </div>
              <p class="event-description">This month we're discussing "Dune" by Frank Herbert. New members are always
                welcome, JOIN NOW!</p>
              <button class="event-btn">Join Here <i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </div>

        <!-- Event 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-card">
            <div class="event-img">
              <img
                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80"
                alt="Children's Event">
              <div class="event-date">
                <?php
                     $randomDays = rand(1, 30);
                            $futureDate = date('M j, Y', strtotime("+$randomDays days"));
                            echo $futureDate;
                    ?>
              </div>
              <div class="event-category">Children's Event</div>
            </div>
            <div class="event-content">
              <h3 class="event-title">Summer Reading Kickoff</h3>
              <div class="event-details">
                <p><i class="fas fa-clock"></i> 10:00 AM - 12:00 PM</p>
                <p><i class="fas fa-map-marker-alt"></i> Children's Library</p>
              </div>
              <p class="event-description">Celebrate the start of our summer reading program with stories, crafts, and
                special guests for kids of all ages.</p>
              <button class="event-btn">Join Here <i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center">
        <button class="view-all-btn">View All Events</button>
      </div>
    </div>
  </section>


  <!--Why choose Us-->
<section class="choose-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title1">Why Choose Literature Oasis</h2>
            <p class="section-subtitle1">Discover what makes our library management system the preferred choice for knowledge seekers</p>
        </div>
        
        <div class="row align-items-center">
            <!-- Image Column -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="side-image">
                    <img src="https://images.pexels.com/photos/32853892/pexels-photo-32853892.jpeg" 
                         alt="Modern Library Space" class="img-fluid">
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h3 class="feature-title">Extensive Collection</h3>
                            <p class="feature-description">Access over 10,000 physical and digital resources spanning diverse genres and subjects.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="feature-title">24/7 Accessibility</h3>
                            <p class="feature-description">Our digital platform is always available, allowing you to browse and reserve items anytime.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <h3 class="feature-title">Community Focused</h3>
                            <p class="feature-description">Join a vibrant community of learners with regular events, workshops, and book clubs.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="feature-title">Advanced Search</h3>
                            <p class="feature-description">Find exactly what you need with our powerful search tools and personalized recommendations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="testimonial-section">
            <div class="container">
                <p class="testimonial-text">"Literature Oasis has transformed how our community accesses knowledge. The seamless system makes managing borrowings and discoveries an absolute pleasure."</p>
                <p class="testimonial-author">Dr. Sarah Johnson</p>
                <p class="testimonial-role">Head Librarian</p>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <button href="#" class="see-more-btn">Become a Member Today <i class="fas fa-arrow-right ms-2"></i></button>
        </div>
    </div>
</section>


<!--News and Events-->
<section class="news-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title2">Historical News & Events</h2>
            <p class="section-subtitle2">Explore fascinating stories from history and discover how they shaped our world</p>
        </div>
        
        <div class="category-filter">
            <button class="category-btn active">All Topics</button>
            <button class="category-btn">History of the Library</button>
            <button class="category-btn">Great Depression</button>
            <button class="category-btn">Civil War</button>
            <button class="category-btn">Rocky Mountains</button>
            <button class="category-btn">Deconstructing History</button>
        </div>
        
        <div class="row">
            <!-- News Item 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.pexels.com/photos/6414504/pexels-photo-6414504.jpeg" alt="Library History">
                        <div class="news-date">May 15, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">History Of The Library: From Scrolls To Digital</h3>
                        <p class="news-excerpt">Tracing the evolution of knowledge preservation from ancient libraries to the digital age and how it transformed access to information.</p>
                        <div class="news-meta">
                            <span class="news-category">Library History</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News Item 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.pexels.com/photos/7929249/pexels-photo-7929249.jpeg" alt="Great Depression">
                        <div class="news-date">Apr 28, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">Great Depression: How Libraries Became Community Sanctuaries</h3>
                        <p class="news-excerpt">During the toughest economic times, libraries provided not just knowledge but also warmth, community, and hope for millions of Americans.</p>
                        <div class="news-meta">
                            <span class="news-category">Great Depression</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News Item 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.pexels.com/photos/31326473/pexels-photo-31326473.jpeg" alt="Civil War">
                        <div class="news-date">Apr 12, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">Civil War: The Role of Libraries in Preserving History</h3>
                        <p class="news-excerpt">How libraries during and after the Civil War worked to preserve documents, letters, and records that would become invaluable to historians.</p>
                        <div class="news-meta">
                            <span class="news-category">Civil War</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News Item 4 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=700&q=80" alt="Rocky Mountains">
                        <div class="news-date">Mar 30, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">How The Rocky Mountains Were Discovered and Mapped</h3>
                        <p class="news-excerpt">The fascinating story of the Lewis and Clark expedition and how they documented the majestic Rocky Mountains, changing geographical understanding.</p>
                        <div class="news-meta">
                            <span class="news-category">Rocky Mountains</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News Item 5 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.pexels.com/photos/5412866/pexels-photo-5412866.jpeg" alt="Library Security">
                        <div class="news-date">Mar 18, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">Library Office Security Through The Ages</h3>
                        <p class="news-excerpt">From medieval chain libraries to modern digital security - how the protection of knowledge has evolved over centuries.</p>
                        <div class="news-meta">
                            <span class="news-category">Library Administration</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News Item 6 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://images.pexels.com/photos/28239618/pexels-photo-28239618.jpeg" alt="Deconstructing History">
                        <div class="news-date">Feb 22, 2023</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">Deconstructing History: Things You Didn't Know</h3>
                        <p class="news-excerpt">Uncovering little-known facts about historical events that challenge conventional understanding and offer new perspectives.</p>
                        <div class="news-meta">
                            <span class="news-category">Deconstructing History</span>
                            <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--         
        <div class="text-center mt-5">
            <a href="#" class="view-all-btn">View All Historical Articles</a>
        </div> -->
    </div>
</section>

<!--Scrolling New & Notable books-->
  <div class="scroll-container py-5">
            <div class="section-header4">
            <h2 class="section-title4">New & Notable Books</h2>
            <p class="section-subtitle4">Discover the latest additions to our collection and trending titles</p>
            </div>
    <div class="markeds">
      <img src="https://m.media-amazon.com/images/I/41ZeaEn3V4L._SY445_SX342_.jpg" class="img-fluid" alt="img">
      <img src="https://m.media-amazon.com/images/I/41SUSwxQ14L._SY445_SX342_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/81F90H7hnML._SY425_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/61xivWmExiL._SY425_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/41ACElFKjiL._SY445_SX342_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/51LkGoOMFfL._SY445_SX342_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/61pxCVEdsoL._SX342_SY445_.jpg" class="img-fluid" alt="img">
      <img src="https://m.media-amazon.com/images/I/51xsawId6aL._SY425_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/61O4bFCGQEL._SY425_.jpg" alt="img" class="img-fluid">

      <img src="https://m.media-amazon.com/images/I/61mK0NQEfDL._SY342_.jpg" class="img-fluid" alt="img">
      <img src="https://m.media-amazon.com/images/I/51c5mz+94gL._SX342_SY445_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/41STAca7iDL._SX342_SY445_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/414ZlRouHKL._SX342_SY445_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/41j-FuWg9QL._SY445_SX342_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/61V2NedeHQL._SX342_SY445_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/71IC0iRkrgL._SY342_.jpg" class="img-fluid" alt="img">
      <img src="https://m.media-amazon.com/images/I/81xz+scRYnL._SY342_.jpg" alt="img" class="img-fluid">
      <img src="https://m.media-amazon.com/images/I/81aVaKnJYvL._SY342_.jpg" alt="img" class="img-fluid">

    </div>
  </div>


<!--footer-->
  <?php   include '../library/include/footer.php'; ?>

</body>

</html>