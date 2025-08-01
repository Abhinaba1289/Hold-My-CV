<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <span class="brand-text">Your <span class="inner-text">Dashboard</span></span>
    </a>
    <div class="navbar-actions">
      <a href="actions/logout.action.php" class="logout-btn">
        <i class="bi bi-box-arrow-left"></i>
        <span>Logout</span>
      </a>
    </div>
  </div>
</nav>

<style>
  :root {
    --navbar-bg: var(--card-bg);
    --navbar-border: var(--border);
    --primary: #6e45e2;
    --primary-dark: #5d3bc0;
    --danger: #dc3545;
    --danger-dark: #c82333;
    --text: var(--dark-gray);
  }

  .navbar {
    background: var(--navbar-bg);
    padding: 0.8rem 0;
    border-bottom: 1px solid var(--navbar-border);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 0;
    z-index: 1030;
  }

  .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 1rem;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .brand-text {
    font-weight: 700;
    font-size: 2rem;
    color: var(--text);
  }

  .inner-text {
    color: var(--primary);
    font-weight: 700;
    

  } 

  .logout-btn {
    background: var(--danger-dark);
    color: white;
    padding: 0.6rem 1.25rem;
    border-radius: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .logout-btn:hover {
    background: var(--danger-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
  }

  /* Dark mode styles */
  body.dark-mode .navbar {
    background: var(--darker);
    border-bottom: 1px solid var(--dark-border);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
  }

  @media (max-width: 768px) {
    .container {
      padding: 0 1.5rem;
    }
    
    .brand-text {
      font-size: 1.1rem;
    }
    
    .logout-btn {
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
    }
  }

  @media (max-width: 576px) {
    .container {
      padding: 0 1rem;
    }
    
    .brand-text {
      display: none;
    }
    
    .logout-btn span {
      display: none;
    }
    
    .logout-btn i {
      margin: 0;
    }
  }
</style>