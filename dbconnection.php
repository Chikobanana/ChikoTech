<?php
/**
 * ChikoTech Database Connection and Helper Functions
 * 
 * This file contains the database connection configuration and helper functions
 * for interacting with the ChikoTech website database.
 */

// Database Configuration
define('DB_HOST', 'localhost');      // Database host
define('DB_NAME', 'chikotech');  // Database name
define('DB_USER', 'root');           // Database username (update for production)
define('DB_PASS', '');               // Database password (update for production)
define('DB_CHARSET', 'utf8mb4');     // Database charset

/**
 * Create a database connection
 * 
 * @return PDO Database connection object
 */
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // For production, you should log the error instead of displaying it
        die("Database Connection Failed: " . $e->getMessage());
    }
}

/**
 * Get a website setting value by key
 * 
 * @param string $key The setting key
 * @param string $default Default value if setting not found
 * @return string The setting value or default
 */
function getSetting($key, $default = '') {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT setting_value FROM website_settings WHERE setting_key = :key");
        $stmt->execute(['key' => $key]);
        $result = $stmt->fetch();
        
        return $result ? $result['setting_value'] : $default;
    } catch (PDOException $e) {
        error_log("Error fetching setting: " . $e->getMessage());
        return $default;
    }
}

/**
 * Get all services
 * 
 * @param bool $featuredOnly Get only featured services
 * @return array Array of services
 */
function getServices($featuredOnly = false) {
    try {
        $db = getDBConnection();
        $sql = "SELECT * FROM services";
        
        if ($featuredOnly) {
            $sql .= " WHERE is_featured = 1";
        }
        
        $sql .= " ORDER BY display_order ASC";
        $stmt = $db->query($sql);
        
        $services = $stmt->fetchAll();
        
        // Get features for each service
        foreach ($services as &$service) {
            $featureStmt = $db->prepare("SELECT * FROM service_features WHERE service_id = ? ORDER BY display_order ASC");
            $featureStmt->execute([$service['service_id']]);
            $service['features'] = $featureStmt->fetchAll();
        }
        
        return $services;
    } catch (PDOException $e) {
        error_log("Error fetching services: " . $e->getMessage());
        return [];
    }
}

/**
 * Get projects
 * 
 * @param bool $featuredOnly Get only featured projects
 * @param int $limit Maximum number of projects to return
 * @return array Array of projects
 */
function getProjects($featuredOnly = false, $limit = 0) {
    try {
        $db = getDBConnection();
        $sql = "SELECT * FROM projects";
        
        if ($featuredOnly) {
            $sql .= " WHERE is_featured = 1";
        }
        
        $sql .= " ORDER BY display_order ASC";
        
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $db->query($sql);
        $projects = $stmt->fetchAll();
        
        // Get technologies for each project
        foreach ($projects as &$project) {
            $techSql = "SELECT t.* FROM technologies t
                        JOIN project_technologies pt ON t.technology_id = pt.technology_id
                        WHERE pt.project_id = ?";
            $techStmt = $db->prepare($techSql);
            $techStmt->execute([$project['project_id']]);
            $project['technologies'] = $techStmt->fetchAll();
        }
        
        return $projects;
    } catch (PDOException $e) {
        error_log("Error fetching projects: " . $e->getMessage());
        return [];
    }
}

/**
 * Get team members
 * 
 * @param int $limit Maximum number of team members to return
 * @return array Array of team members
 */
function getTeamMembers($limit = 0) {
    try {
        $db = getDBConnection();
        $sql = "SELECT * FROM team_members WHERE is_active = 1 ORDER BY display_order ASC";
        
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching team members: " . $e->getMessage());
        return [];
    }
}

/**
 * Get testimonials
 * 
 * @param int $limit Maximum number of testimonials to return
 * @return array Array of testimonials
 */
function getTestimonials($limit = 0) {
    try {
        $db = getDBConnection();
        $sql = "SELECT * FROM testimonials ORDER BY is_featured DESC, testimonial_id DESC";
        
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching testimonials: " . $e->getMessage());
        return [];
    }
}

/**
 * Get website statistics
 * 
 * @return array Array of statistics
 */
function getStatistics() {
    try {
        $db = getDBConnection();
        $sql = "SELECT * FROM statistics WHERE is_visible = 1 ORDER BY display_order ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching statistics: " . $e->getMessage());
        return [];
    }
}

/**
 * Save a contact form submission
 * 
 * @param array $data The form data
 * @return bool True if successful, false otherwise
 */
function saveContactSubmission($data) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("
            INSERT INTO contact_submissions (name, email, subject, message, ip_address, user_agent)
            VALUES (:name, :email, :subject, :message, :ip, :agent)
        ");
        
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? '',
            'message' => $data['message'],
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    } catch (PDOException $e) {
        error_log("Error saving contact submission: " . $e->getMessage());
        return false;
    }
}

/**
 * Start a new chat session
 * 
 * @return string The session UUID
 */
function startChatSession() {
    try {
        $db = getDBConnection();
        
        // Generate a UUID
        $uuid = bin2hex(random_bytes(16));
        
        $stmt = $db->prepare("
            INSERT INTO chat_sessions (session_uuid, ip_address, user_agent)
            VALUES (:uuid, :ip, :agent)
        ");
        
        $stmt->execute([
            'uuid' => $uuid,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
        
        // Add the welcome message
        $sessionId = $db->lastInsertId();
        
        $welcomeMsg = getChatbotSetting('welcome_message');
        saveChatMessage($sessionId, 'bot', $welcomeMsg);
        
        return $uuid;
    } catch (PDOException $e) {
        error_log("Error starting chat session: " . $e->getMessage());
        return false;
    }
}

/**
 * Get a chat session by UUID
 * 
 * @param string $uuid The session UUID
 * @return array|false The session data or false if not found
 */
function getChatSession($uuid) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT * FROM chat_sessions WHERE session_uuid = :uuid");
        $stmt->execute(['uuid' => $uuid]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error getting chat session: " . $e->getMessage());
        return false;
    }
}

/**
 * Save a chat message
 * 
 * @param int $sessionId The chat session ID
 * @param string $sender The sender type ('user', 'bot', 'agent')
 * @param string $message The message text
 * @param int|null $agentId The agent ID if sent by an agent
 * @return bool True if successful, false otherwise
 */
function saveChatMessage($sessionId, $sender, $message, $agentId = null) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("
            INSERT INTO chat_messages (session_id, sender_type, message_text, agent_id)
            VALUES (:session_id, :sender, :message, :agent_id)
        ");
        
        return $stmt->execute([
            'session_id' => $sessionId,
            'sender' => $sender,
            'message' => $message,
            'agent_id' => $agentId
        ]);
    } catch (PDOException $e) {
        error_log("Error saving chat message: " . $e->getMessage());
        return false;
    }
}

/**
 * Get chat messages for a session
 * 
 * @param int $sessionId The chat session ID
 * @return array Array of messages
 */
function getChatMessages($sessionId) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("
            SELECT * FROM chat_messages 
            WHERE session_id = :session_id 
            ORDER BY created_at ASC
        ");
        $stmt->execute(['session_id' => $sessionId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error getting chat messages: " . $e->getMessage());
        return [];
    }
}

/**
 * Get a chatbot response based on user message
 * 
 * @param string $message The user message
 * @return string The bot response
 */
function getChatbotResponse($message) {
    try {
        $db = getDBConnection();
        
        // Convert message to lowercase for better matching
        $messageLower = strtolower($message);
        
        // Find matching response with highest priority
        $stmt = $db->prepare("
           SELECT response FROM chatbot_responses 
            WHERE INSTR(:message_lower, trigger_phrase) > 0
            OR :message = trigger_phrase
            ORDER BY priority DESC, LENGTH(trigger_phrase) DESC
            LIMIT 1
        ");
        
        $stmt->execute(['message_lower' => $messageLower]);
        $result = $stmt->fetch();
        
        if ($result) {
            return $result['response'];
        }
        
        // No match found, return default response
        return getChatbotSetting('default_response');
    } catch (PDOException $e) {
        error_log("Error getting chatbot response: " . $e->getMessage());
        return "I'm sorry, I encountered an error. Please try again later.";
    }
}

/**
 * Get a chatbot setting
 * 
 * @param string $key The setting key
 * @param string $default Default value if setting not found
 * @return string The setting value
 */
function getChatbotSetting($key, $default = '') {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT setting_value FROM chatbot_settings WHERE setting_key = :key");
        $stmt->execute(['key' => $key]);
        $result = $stmt->fetch();
        
        return $result ? $result['setting_value'] : $default;
    } catch (PDOException $e) {
        error_log("Error fetching chatbot setting: " . $e->getMessage());
        return $default;
    }
}

/**
 * Save a newsletter subscription
 * 
 * @param string $email The subscriber email
 * @param string $name The subscriber name (optional)
 * @return bool True if successful, false otherwise
 */
function saveNewsletterSubscription($email, $name = '') {
    try {
        $db = getDBConnection();
        
        // Check if email already exists
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM newsletter_subscriptions WHERE email = :email");
        $checkStmt->execute(['email' => $email]);
        
        if ($checkStmt->fetchColumn() > 0) {
            return false; // Already subscribed
        }
        
        $stmt = $db->prepare("
            INSERT INTO newsletter_subscriptions (email, name, ip_address)
            VALUES (:email, :name, :ip)
        ");
        
        return $stmt->execute([
            'email' => $email,
            'name' => $name,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
    } catch (PDOException $e) {
        error_log("Error saving newsletter subscription: " . $e->getMessage());
        return false;
    }
}

/**
 * Get blog posts
 * 
 * @param int $limit Maximum number of posts to return
 * @param int $offset Offset for pagination
 * @param string $category Category slug (optional)
 * @return array Array of blog posts
 */
function getBlogPosts($limit = 10, $offset = 0, $category = null) {
    try {
        $db = getDBConnection();
        $params = [];
        
        $sql = "
            SELECT p.*, u.name as author_name, u.avatar as author_avatar,
                  (SELECT COUNT(*) FROM blog_comments WHERE post_id = p.post_id AND is_approved = 1) as comment_count
            FROM blog_posts p
            LEFT JOIN users u ON p.author_id = u.user_id
            WHERE p.status = 'published'
        ";
        
        if ($category) {
            $sql .= " AND p.post_id IN (
                SELECT pc.post_id FROM post_categories pc
                JOIN blog_categories c ON pc.category_id = c.category_id
                WHERE c.slug = :category
            )";
            $params['category'] = $category;
        }
        
        $sql .= " ORDER BY p.published_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if ($category) {
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $posts = $stmt->fetchAll();
        
        // Get categories for each post
        foreach ($posts as &$post) {
            $catSql = "
                SELECT c.* FROM blog_categories c
                JOIN post_categories pc ON c.category_id = pc.category_id
                WHERE pc.post_id = :post_id
            ";
            $catStmt = $db->prepare($catSql);
            $catStmt->execute(['post_id' => $post['post_id']]);
            $post['categories'] = $catStmt->fetchAll();
        }
        
        return $posts;
    } catch (PDOException $e) {
        error_log("Error fetching blog posts: " . $e->getMessage());
        return [];
    }
}

/**
 * Get blog post by slug
 * 
 * @param string $slug The post slug
 * @return array|false The post data or false if not found
 */
function getBlogPost($slug) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("
            SELECT p.*, u.name as author_name, u.avatar as author_avatar
            FROM blog_posts p
            LEFT JOIN users u ON p.author_id = u.user_id
            WHERE p.slug = :slug AND p.status = 'published'
        ");
        $stmt->execute(['slug' => $slug]);
        $post = $stmt->fetch();
        
        if (!$post) {
            return false;
        }
        
        // Get categories
        $catStmt = $db->prepare("
            SELECT c.* FROM blog_categories c
            JOIN post_categories pc ON c.category_id = pc.category_id
            WHERE pc.post_id = :post_id
        ");
        $catStmt->execute(['post_id' => $post['post_id']]);
        $post['categories'] = $catStmt->fetchAll();
        
        // Get comments
        $commentStmt = $db->prepare("
            SELECT * FROM blog_comments
            WHERE post_id = :post_id AND is_approved = 1
            ORDER BY created_at ASC
        ");
        $commentStmt->execute(['post_id' => $post['post_id']]);
        $post['comments'] = $commentStmt->fetchAll();
        
        return $post;
    } catch (PDOException $e) {
        error_log("Error fetching blog post: " . $e->getMessage());
        return false;
    }
}

/**
 * Get blog categories
 * 
 * @return array Array of categories
 */
function getBlogCategories() {
    try {
        $db = getDBConnection();
        $stmt = $db->query("
            SELECT c.*, COUNT(pc.post_id) as post_count
            FROM blog_categories c
            LEFT JOIN post_categories pc ON c.category_id = pc.category_id
            LEFT JOIN blog_posts p ON pc.post_id = p.post_id AND p.status = 'published'
            GROUP BY c.category_id
            HAVING post_count > 0
            ORDER BY c.name ASC
        ");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching blog categories: " . $e->getMessage());
        return [];
    }
}

/**
 * Save a blog comment
 * 
 * @param array $data The comment data
 * @return bool True if successful, false otherwise
 */
function saveBlogComment($data) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("
            INSERT INTO blog_comments (post_id, name, email, comment, ip_address)
            VALUES (:post_id, :name, :email, :comment, :ip)
        ");
        
        return $stmt->execute([
            'post_id' => $data['post_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'comment' => $data['comment'],
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
    } catch (PDOException $e) {
        error_log("Error saving blog comment: " . $e->getMessage());
        return false;
    }
}
?>