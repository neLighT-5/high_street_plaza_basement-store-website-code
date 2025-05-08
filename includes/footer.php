<?php
// includes/footer.php

?>
    </main> <!-- Close main content from header -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>High Street Plaza</h3>
                    <p>Your Trusted Hardware Retailer</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?= BASE_URL ?>index.php">Home</a></li>
                        <li><a href="<?= BASE_URL ?>Pages/products.php">Products</a></li>
                        <li><a href="<?= BASE_URL ?>Pages/Contacts.php">Contacts</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p><i class="fas fa-map-marker-alt"></i> San Fernando, High Street</p>
                    <p><i class="fas fa-phone"></i> (868) 478-8230 </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> High Street Plaza. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Optional: only load JS if needed -->
    <script src="<?= BASE_URL ?>js/main.js"></script>
    </body>
</html>
