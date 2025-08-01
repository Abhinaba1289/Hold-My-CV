<footer class="footer" >
  <div style="max-width:1400px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;padding:0 2rem;">
    <span class="text-muted">&copy; <?= date('Y') ?> Hold My CV. All rights reserved.</span>
  </div>
</footer>
<div style="height:80px;"></div> <!-- Reduced spacer for better layout -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php
$fn->error();
$fn->alert();
?>
</script>

<style>
    .footer {
        background: var(--card-bg) !important;
        border-top: 1px solid var(--border) !important;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: -1;
        padding: 1rem 0;
        transition: all 0.3s ease;
    }
    
    .footer a {
        color: var(--gray);
        text-decoration: none;
        transition: color 0.2s ease;
        margin-right: 1.5rem;
    }
    
    .footer a:last-child {
        margin-right: 0;
    }
    
    .footer a:hover {
        color: var(--primary);
    }
    
    .text-muted {
        color: var(--gray) !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .footer div {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
            padding: 0 1rem;
        }
        
        .footer a {
            margin-right: 0;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .footer a:last-child {
            margin-bottom: 0;
        }
    }
</style>