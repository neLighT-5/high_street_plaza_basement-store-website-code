<div class="top-bar">
    <div class="container">
        <div class="user-actions">
            <?php if(isset($_SESSION['loggedin'])): ?>
                <span style="color: var(--light); margin-right: 15px;">
                    <i class="fas fa-user"></i> <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)
                </span>
                <a href="<?php echo BASE_URL . '/pages/logout.php' ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php endif; ?>
            <a href="#" id="cart-btn"><i class="fas fa-shopping-cart"></i> Cart (<span id="cart-count">0</span>)</a>
        </div>
    </div>
</div>