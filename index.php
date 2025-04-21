<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChikoTech | Advanced IT Solutions</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
   
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="logo-container">
                    <div class="logo-placeholder">CT</div>
                    <div class="company-name">ChikoTech</div>
                </div>
                <nav>
                    <ul id="nav-menu">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#projects">Projects</a></li>
                        <li><a href="#team">Team</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <button class="theme-toggle" id="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="mobile-menu-btn" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-particles" id="particles"></div>
        <div class="container">
            <div class="hero-inner">
                <h1 class="hero-title">Advanced IT Solutions</h1>
                <h2 class="hero-subtitle">for Modern Businesses</h2>
                <p class="hero-text">ChikoTech delivers cutting-edge technology services to help your business thrive in the digital age. From web development to system integration, we've got your tech needs covered.</p>
                
                <div class="stats-container">
                    <div class="stat">
                        <span class="stat-number">250+</span>
                        <span class="stat-label">Projects Completed</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Client Satisfaction</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">12+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                </div>
                
                <div class="hero-visual">
                    <div class="hero-visual-3d">
                        <div class="cube">
                            <div class="cube-face face-front"><i class="fas fa-code"></i></div>
                            <div class="cube-face face-back"><i class="fas fa-server"></i></div>
                            <div class="cube-face face-right"><i class="fas fa-mobile-alt"></i></div>
                            <div class="cube-face face-left"><i class="fas fa-database"></i></div>
                            <div class="cube-face face-top"><i class="fas fa-network-wired"></i></div>
                            <div class="cube-face face-bottom"><i class="fas fa-shield-alt"></i></div>
                        </div>
                    </div>
                </div>
                
                <a href="#contact" class="cta-btn">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <!-- Web Development -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Web Development</h3>
                        <p class="service-description">Custom web solutions designed to represent your brand and meet your business goals with cutting-edge technologies.</p>
                        <ul class="service-features">
                            <li>Responsive Design</li>
                            <li>E-commerce Solutions</li>
                            <li>CMS Integration</li>
                            <li>SEO Optimization</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- App Development -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">App Development</h3>
                        <p class="service-description">Native and cross-platform mobile applications that deliver exceptional user experiences across all devices.</p>
                        <ul class="service-features">
                            <li>iOS & Android Apps</li>
                            <li>Cross-platform Solutions</li>
                            <li>UI/UX Design</li>
                            <li>App Maintenance</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- System Development -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">System Development</h3>
                        <p class="service-description">Custom software solutions tailored to optimize your business operations and improve efficiency.</p>
                        <ul class="service-features">
                            <li>ERP Systems</li>
                            <li>CRM Solutions</li>
                            <li>Business Intelligence</li>
                            <li>Process Automation</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Network Solutions -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Network Solutions</h3>
                        <p class="service-description">Secure and reliable networking infrastructure design, implementation, and maintenance services.</p>
                        <ul class="service-features">
                            <li>Network Design</li>
                            <li>Network Security</li>
                            <li>Cloud Integration</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Cloud Services -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Cloud Services</h3>
                        <p class="service-description">Scalable cloud solutions that help businesses reduce costs, improve flexibility, and enhance security.</p>
                        <ul class="service-features">
                            <li>Cloud Migration</li>
                            <li>AWS & Azure Solutions</li>
                            <li>Cloud Security</li>
                            <li>Serverless Architecture</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Cybersecurity -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Cybersecurity</h3>
                        <p class="service-description">Comprehensive security solutions to protect your business data, systems, and users from cyber threats.</p>
                        <ul class="service-features">
                            <li>Security Audits</li>
                            <li>Penetration Testing</li>
                            <li>Threat Detection</li>
                            <li>Compliance Solutions</li>
                        </ul>
                        <a href="#contact" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-inner">
                <div class="about-content">
                    <h2>We're Passionate About Technology</h2>
                    <p class="about-text">At ChikoTech, we combine technical expertise with innovative thinking to deliver IT solutions that transform businesses. With over 12 years of experience, our team of experts is dedicated to helping clients navigate the complex world of technology.</p>
                    <p class="about-text">Our mission is to provide exceptional IT services that enable businesses to thrive in the digital era. We believe in building long-term partnerships with our clients, understanding their unique challenges, and delivering solutions that drive growth and success.</p>
                    
                    <div class="about-stats">
                        <div class="about-stat">
                            <div class="about-stat-number">5M+</div>
                            <div class="about-stat-label">Code Lines</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat-number">450+</div>
                            <div class="about-stat-label">Clients</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat-number">20+</div>
                            <div class="about-stat-label">Countries</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat-number">8.2%</div>
                            <div class="about-stat-label">ROI Increase</div>
                        </div>
                    </div>
                </div>
                <div class="about-visual">
                    <img src="/api/placeholder/600/400" alt="ChikoTech Team" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects" id="projects">
        <div class="container">
            <h2 class="section-title">Our Latest Projects</h2>
            <div class="projects-grid">
                <!-- Project 1 -->
                <div class="project-card">
                    <div class="project-image">
                        <img src="/api/placeholder/400/250" alt="Project 1">
                    </div>
                    <div class="project-content">
                        <span class="project-category">Web Development</span>
                        <h3 class="project-title">E-Commerce Platform</h3>
                        <p class="project-description">A comprehensive e-commerce solution with advanced product management, secure payment processing, and real-time analytics.</p>
                        <a href="#" class="project-link">View Case Study <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="project-card">
                    <div class="project-image">
                        <img src="/api/placeholder/400/250" alt="Project 2">
                    </div>
                    <div class="project-content">
                        <span class="project-category">Mobile App</span>
                        <h3 class="project-title">Health Tracking App</h3>
                        <p class="project-description">A cross-platform mobile application that helps users track fitness goals, nutrition, and health metrics with personalized insights.</p>
                        <a href="#" class="project-link">View Case Study <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="project-card">
                    <div class="project-image">
                        <img src="/api/placeholder/400/250" alt="Project 3">
                    </div>
                    <div class="project-content">
                        <span class="project-category">System Development</span>
                        <h3 class="project-title">Inventory Management System</h3>
                        <p class="project-description">A robust inventory management solution that streamlines operations, reduces costs, and provides real-time stock visibility.</p>
                        <a href="#" class="project-link">View Case Study <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Client Testimonials</h2>
            <div class="testimonials-container">
                <div class="testimonials-carousel" id="testimonials-carousel">
                    <!-- Testimonial 1 -->
                    <div class="testimonial-item active">
                        <div class="testimonial-content">
                            <p class="testimonial-text">ChikoTech completely transformed our business operations with their custom ERP solution. Their team was professional, responsive, and truly understood our needs. The system has improved our efficiency by 40%.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/api/placeholder/80/80" alt="Client">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">Sarah Johnson</h4>
                                <span class="author-position">CEO, GlobalTech Inc.</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p class="testimonial-text">The mobile app developed by ChikoTech exceeded our expectations. Their attention to detail and focus on user experience resulted in an app that our customers love. Downloads increased by 200% within the first month.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/api/placeholder/80/80" alt="Client">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">David Wilson</h4>
                                <span class="author-position">Marketing Director, AppMaster</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p class="testimonial-text">ChikoTech's cybersecurity services have given us peace of mind. Their team identified vulnerabilities we weren't aware of and implemented robust security measures that protect our sensitive data and systems.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/api/placeholder/80/80" alt="Client">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">Michael Brown</h4>
                                <span class="author-position">CTO, SecureFinance Ltd.</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-controls">
                    <button class="testimonial-btn" id="prev-testimonial">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="testimonial-btn" id="next-testimonial">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="testimonial-indicators" id="testimonial-indicators">
                    <span class="testimonial-indicator active" data-index="0"></span>
                    <span class="testimonial-indicator" data-index="1"></span>
                    <span class="testimonial-indicator" data-index="2"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team" id="team">
        <div class="container">
            <h2 class="section-title">Meet Our Experts</h2>
            <div class="team-grid">
                <!-- Team Member 1 -->
                <div class="team-member">
                    <div class="member-image">
                        <img src="/api/placeholder/300/300" alt="Team Member">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Alex Morgan</h3>
                        <span class="member-position">Chief Technical Officer</span>
                        <p class="member-bio">With over 15 years of experience in software development, Alex leads our technical team with expertise in AI and cloud computing.</p>
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="team-member">
                    <div class="member-image">
                        <img src="/api/placeholder/300/300" alt="Team Member">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Emily Chen</h3>
                        <span class="member-position">UI/UX Design Lead</span>
                        <p class="member-bio">Emily specializes in creating intuitive user experiences that combine aesthetics with functionality for digital products.</p>
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-dribbble"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="team-member">
                    <div class="member-image">
                        <img src="/api/placeholder/300/300" alt="Team Member">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Marcus Taylor</h3>
                        <span class="member-position">Network Security Expert</span>
                        <p class="member-bio">Marcus ensures our clients' networks are protected with the latest security protocols and best practices in cybersecurity.</p>
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="team-member">
                    <div class="member-image">
                        <img src="/api/placeholder/300/300" alt="Team Member">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">Sophia Rodriguez</h3>
                        <span class="member-position">Full Stack Developer</span>
                        <p class="member-bio">Sophia brings creative solutions to complex problems with her expertise in various programming languages and frameworks.</p>
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-stack-overflow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="contact-inner">
                <div class="contact-info">
                    <h2>Let's Start a Conversation</h2>
                    <p class="contact-text">Ready to discuss your project? Our team is here to help you navigate the complex world of technology and find the right solutions for your business needs.</p>
                    <ul class="contact-details">
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span class="contact-label">Our Location</span>
                                <span class="contact-value">123 Tech Street, Innovation City</span>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <span class="contact-label">Call Us</span>
                                <a href="tel:+1234567890" class="contact-value">+123 456 7890</a>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <span class="contact-label">Email Us</span>
                                <a href="mailto:info@chikotech.com" class="contact-value">info@chikotech.com</a>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <span class="contact-label">Working Hours</span>
                                <span class="contact-value">Mon - Fri: 9AM - 6PM</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="contact-form">
                    <form id="contact-form">
                        <div class="form-group">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea id="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="form-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-column">
                    <h3>ChikoTech</h3>
                    <p>Advanced IT solutions for modern businesses. We help organizations leverage technology to achieve their goals and stay ahead of the competition.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#services"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href