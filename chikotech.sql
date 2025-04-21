-- ChikoTech Website Database Schema

-- Create database
CREATE DATABASE chikotech;
USE chikotech;

-- Users Table (for admin and team members)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Store hashed passwords
    email VARCHAR(100) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role ENUM('admin', 'editor', 'team_member') NOT NULL DEFAULT 'team_member',
    profile_image VARCHAR(255),
    position VARCHAR(100),
    bio TEXT,
    linkedin_url VARCHAR(255),
    twitter_url VARCHAR(255),
    github_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Services Table
CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    icon VARCHAR(50) NOT NULL,  -- Font Awesome icon class
    short_description VARCHAR(255) NOT NULL,
    full_description TEXT,
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Service Features
CREATE TABLE service_features (
    feature_id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    feature_text VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 0,
    FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE CASCADE
);

-- Projects Table
CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    category VARCHAR(50) NOT NULL,
    client VARCHAR(100),
    completion_date DATE,
    image_url VARCHAR(255),
    short_description VARCHAR(255) NOT NULL,
    full_description TEXT,
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Project Technologies (Many-to-Many relationship with technologies)
CREATE TABLE technologies (
    technology_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    icon VARCHAR(50)  -- Font Awesome icon class or custom icon
);

CREATE TABLE project_technologies (
    project_id INT NOT NULL,
    technology_id INT NOT NULL,
    PRIMARY KEY (project_id, technology_id),
    FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE,
    FOREIGN KEY (technology_id) REFERENCES technologies(technology_id) ON DELETE CASCADE
);

-- Testimonials Table
CREATE TABLE testimonials (
    testimonial_id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    client_position VARCHAR(100),
    client_company VARCHAR(100),
    client_image VARCHAR(255),
    testimonial_text TEXT NOT NULL,
    rating TINYINT DEFAULT 5,  -- 1-5 star rating
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Team Members Table
CREATE TABLE team_members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- Link to user account if they have one
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    bio TEXT,
    image_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    twitter_url VARCHAR(255),
    github_url VARCHAR(255),
    other_social_url VARCHAR(255),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Contact Form Submissions
CREATE TABLE contact_submissions (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    ip_address VARCHAR(45),  -- IPv4 or IPv6 address
    user_agent TEXT,  -- Browser/device info
    status ENUM('pending', 'read', 'replied', 'spam') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Chat Bot Configuration
CREATE TABLE chatbot_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    welcome_message TEXT NOT NULL DEFAULT 'Hello! Welcome to ChikoTech. How can I assist you today?',
    offline_message TEXT NOT NULL DEFAULT 'Our team is currently offline. Please leave a message and we will get back to you.',
    active_hours_start TIME DEFAULT '09:00:00',
    active_hours_end TIME DEFAULT '18:00:00',
    is_active BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Chat Bot Responses
CREATE TABLE chatbot_responses (
    response_id INT AUTO_INCREMENT PRIMARY KEY,
    keyword VARCHAR(100) NOT NULL,
    response TEXT NOT NULL,
    priority INT DEFAULT 0  -- Higher number = higher priority
);

-- User Chat Sessions
CREATE TABLE chat_sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    session_uuid VARCHAR(36) NOT NULL UNIQUE,  -- UUID for tracking anonymous sessions
    user_name VARCHAR(100),
    user_email VARCHAR(100),
    ip_address VARCHAR(45),
    user_agent TEXT,
    is_closed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Chat Messages
CREATE TABLE chat_messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    session_id INT NOT NULL,
    sender_type ENUM('user', 'bot', 'agent') NOT NULL,
    message_text TEXT NOT NULL,
    agent_id INT,  -- If message is from a human agent
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES chat_sessions(session_id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Website Settings
CREATE TABLE website_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) NOT NULL UNIQUE,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Statistics
CREATE TABLE statistics (
    stat_id INT AUTO_INCREMENT PRIMARY KEY,
    stat_key VARCHAR(50) NOT NULL UNIQUE,  -- e.g., 'projects_completed', 'client_satisfaction', 'years_experience'
    stat_value VARCHAR(50) NOT NULL,  -- e.g., '20+', '95%', '4+'
    stat_label VARCHAR(100) NOT NULL,  -- e.g., 'Projects Completed', 'Client Satisfaction'
    display_order INT DEFAULT 0,
    is_visible BOOLEAN DEFAULT TRUE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog Posts (if you want to add a blog later)
CREATE TABLE blog_posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    excerpt TEXT,
    featured_image VARCHAR(255),
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Blog Categories
CREATE TABLE blog_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Blog Post Categories (Many-to-Many)
CREATE TABLE post_categories (
    post_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (post_id, category_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES blog_categories(category_id) ON DELETE CASCADE
);

-- Newsletter Subscribers
CREATE TABLE subscribers (
    subscriber_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    name VARCHAR(100),
    subscription_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    confirmation_token VARCHAR(100),
    is_confirmed BOOLEAN DEFAULT FALSE
);

-- Insert some initial data

-- Service categories
INSERT INTO services (title, slug, icon, short_description, full_description, is_featured, display_order) VALUES
('Web Development', 'web-development', 'fas fa-laptop-code', 'Custom web solutions designed to represent your brand and meet your business goals with cutting-edge technologies.', 'Our web development team creates custom websites and web applications that are responsive, user-friendly, and optimized for search engines. We use the latest technologies and best practices to ensure your web presence stands out from the competition.', TRUE, 1),
('App Development', 'app-development', 'fas fa-mobile-alt', 'Native and cross-platform mobile applications that deliver exceptional user experiences across all devices.', 'We develop native iOS and Android applications as well as cross-platform solutions that look and feel great on any device. Our mobile development team focuses on creating intuitive user interfaces and robust backend systems.', TRUE, 2),
('System Development', 'system-development', 'fas fa-cogs', 'Custom software solutions tailored to optimize your business operations and improve efficiency.', 'Our system development services include custom software development, ERP systems, CRM solutions, and business intelligence tools. We work closely with your team to understand your business processes and create solutions that streamline operations.', TRUE, 3),
('Network Solutions', 'network-solutions', 'fas fa-network-wired', 'Secure and reliable networking infrastructure design, implementation, and maintenance services.', 'Our network solutions include network design, implementation, security, and maintenance. We ensure your network infrastructure is reliable, secure, and scalable to support your business growth.', FALSE, 4),
('Cloud Services', 'cloud-services', 'fas fa-cloud', 'Scalable cloud solutions that help businesses reduce costs, improve flexibility, and enhance security.', 'We provide comprehensive cloud services including migration, management, and optimization for AWS, Azure, and Google Cloud. Our cloud experts help you leverage the power of the cloud to improve scalability and reduce costs.', FALSE, 5),
('Cybersecurity', 'cybersecurity', 'fas fa-shield-alt', 'Comprehensive security solutions to protect your business data, systems, and users from cyber threats.', 'Our cybersecurity services include security audits, penetration testing, vulnerability assessments, and security policy development. We help you identify and mitigate security risks to protect your valuable business data.', FALSE, 6);

-- Add service features
INSERT INTO service_features (service_id, feature_text, display_order) VALUES
(1, 'Responsive Design', 1),
(1, 'E-commerce Solutions', 2),
(1, 'CMS Integration', 3),
(1, 'SEO Optimization', 4),
(2, 'iOS & Android Apps', 1),
(2, 'Cross-platform Solutions', 2),
(2, 'UI/UX Design', 3),
(2, 'App Maintenance', 4),
(3, 'ERP Systems', 1),
(3, 'CRM Solutions', 2),
(3, 'Business Intelligence', 3),
(3, 'Process Automation', 4);

-- Add some projects
INSERT INTO projects (title, slug, category, client, completion_date, image_url, short_description, is_featured, display_order) VALUES
('E-Commerce Platform', 'e-commerce-platform', 'Web Development', 'GlobalTech Inc.', '2024-06-15', 'assets/web.jpg', 'A comprehensive e-commerce solution with advanced product management, secure payment processing, and real-time analytics.', TRUE, 1),
('Tender Management System', 'tender-management-system', 'Mobile App', 'TenderCorp', '2024-03-22', 'assets/tms.jpg', 'A centralized platform that streamlines tender processes, enhances transparency, and improves bid management efficiency.', TRUE, 2),
('Smart Irrigation System', 'smart-irrigation-system', 'System Development', 'AgriTech Solutions', '2024-01-10', 'assets/sis.jpg', 'An intelligent irrigation solution that conserves water, reduces costs, and delivers real-time control for efficient crop management.', TRUE, 3);

-- Add technologies
INSERT INTO technologies (name, icon) VALUES
('React', 'fab fa-react'),
('Node.js', 'fab fa-node-js'),
('Python', 'fab fa-python'),
('AWS', 'fab fa-aws'),
('Docker', 'fab fa-docker'),
('MySQL', 'fas fa-database');

-- Link technologies to projects
INSERT INTO project_technologies (project_id, technology_id) VALUES
(1, 1), (1, 2), (1, 4), (1, 6),  -- E-Commerce: React, Node.js, AWS, MySQL
(2, 1), (2, 3), (2, 5),  -- Tender Management: React, Python, Docker
(3, 2), (3, 3), (3, 4), (3, 5);  -- Smart Irrigation: Node.js, Python, AWS, Docker

-- Add testimonials
INSERT INTO testimonials (client_name, client_position, client_company, testimonial_text, rating, is_featured) VALUES
('Sarah Johnson', 'CEO', 'GlobalTech Inc.', 'ChikoTech completely transformed our business operations with their custom ERP solution. Their team was professional, responsive, and truly understood our needs. The system has improved our efficiency by 40%.', 5, TRUE),
('David Wilson', 'Marketing Director', 'AppMaster', 'The mobile app developed by ChikoTech exceeded our expectations. Their attention to detail and focus on user experience resulted in an app that our customers love. Downloads increased by 200% within the first month.', 5, TRUE),
('Michael Brown', 'CTO', 'SecureFinance Ltd.', 'ChikoTech\'s cybersecurity services have given us peace of mind. Their team identified vulnerabilities we weren\'t aware of and implemented robust security measures that protect our sensitive data and systems.', 5, TRUE);

-- Add team members
INSERT INTO team_members (name, position, bio, image_url, linkedin_url, twitter_url, github_url, display_order) VALUES
('Chishala Backstone', 'Chief Technical Officer', 'With over 3 years of experience in software development, Backstone leads our technical team with expertise in AI and cloud computing.', '/api/placeholder/300/300', '#', '#', '#', 1),
('Steven Sautu', 'UI/UX Design Lead', 'Steven specializes in creating intuitive user experiences that combine aesthetics with functionality for digital products.', 'assets/StevenSautu.jpg', '#', '#', '#', 2),
('Samuel Sianamate', 'Network Security Expert', 'Samuel ensures our clients\' networks are protected with the latest security protocols and best practices in cybersecurity.', 'assets/Samuel.jpg', '#', '#', '#', 3),
('Justus Micheelo', 'Full Stack Developer', 'Justus brings creative solutions to complex problems with her expertise in various programming languages and frameworks.', 'assets/justus.jpg', '#', '#', '#', 4);

-- Add website statistics
INSERT INTO statistics (stat_key, stat_value, stat_label, display_order) VALUES
('projects_completed', '20+', 'Projects Completed', 1),
('client_satisfaction', '95%', 'Client Satisfaction', 2),
('years_experience', '4+', 'Years Experience', 3),
('code_lines', '1M+', 'Code Lines', 4),
('clients', '50+', 'Clients', 5),
('countries', '4+', 'Countries', 6),
('roi_increase', '20.7%', 'ROI Increase', 7);

-- Add chatbot responses
INSERT INTO chatbot_responses (keyword, response, priority) VALUES
('hello', 'Hi there! How can I help you today with your technology needs?', 10),
('hi', 'Hello! How can I assist you with our IT services today?', 10),
('services', 'We offer a wide range of IT services including Web Development, App Development, System Development, Network Solutions, Cloud Services, and Cybersecurity. Which one are you interested in learning more about?', 20),
('web', 'Our web development services include responsive design, e-commerce solutions, CMS integration, and SEO optimization. Would you like to speak with one of our web development specialists?', 20),
('app', 'We develop both iOS and Android applications with a focus on great user experience and performance. Would you like to know more about our app development process?', 20),
('system', 'Our system development services include custom software, ERP systems, CRM solutions, and business intelligence tools. How can we help improve your business systems?', 20),
('network', 'We provide comprehensive network solutions including design, security, cloud integration, and 24/7 support. What networking challenges are you facing?', 20),
('cloud', 'Our cloud services include migration, AWS & Azure solutions, cloud security, and serverless architecture. How can we help your business leverage the cloud?', 20),
('security', 'We offer security audits, penetration testing, threat detection, and compliance solutions to keep your business data safe. Would you like to discuss your security concerns?', 20),
('pricing', 'Our pricing varies based on project requirements. We\'d be happy to provide a custom quote for your specific needs. Would you like to schedule a consultation?', 30),
('contact', 'You can reach us by phone at +260 9705 53244, by email at chikotech@gmail.com, or by filling out the contact form on our website. How would you prefer to connect?', 30),
('location', 'We are located at Chalimbana University in Chongwe, Lusaka, Zambia. Would you like directions or do you prefer to meet virtually?', 30),
('team', 'Our team consists of experienced professionals in software development, design, cybersecurity, and project management. Would you like to know more about our experts?', 30),
('thanks', 'You\'re welcome! Feel free to reach out if you have any more questions.', 10),
('thank you', 'You\'re welcome! Feel free to reach out if you have any more questions.', 10),
('bye', 'Thank you for chatting with us! Have a great day and we hope to work with you soon.', 10),
('default', 'I\'d be happy to help with that. Would you like to speak with one of our specialists for more detailed information?', 5);

-- Website settings
INSERT INTO website_settings (setting_key, setting_value) VALUES
('site_title', 'ChikoTech - Advanced IT Solutions'),
('meta_description', 'ChikoTech delivers cutting-edge technology services to help your business thrive in the digital age.'),
('company_email', 'chikondeimmanuel@gmail.com'),
('company_phone', '+260 9705 53244'),
('company_address', 'Chalimbana University (Chongwe), Lusaka, Zambia'),
('working_hours', 'Mon - Fri: 9AM - 6PM'),
('facebook_url', '#'),
('twitter_url', '#'),
('linkedin_url', '#'),
('github_url', '#'),
('google_analytics_id', 'UA-XXXXXXXX-X');