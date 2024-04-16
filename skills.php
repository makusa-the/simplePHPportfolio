    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php while($skill = mysqli_fetch_assoc($skills)): { ?>
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
                <h2 class="fw-normal"><?php echo $skill['name']; ?> (Level: <?php echo $skill['level']; ?>)</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
      <?php }endwhile; ?>
    </div><!-- /.row -->
