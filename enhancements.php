<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <title>Homepage</title>
</head>


    <body>

        <?php include 'header.inc'; ?>

        <section class="responsive">
            <section id="responsive">
                <h2 class="title"> Responsive Design</h2>
                <section class="rsv-sum">
                    The php and CSS code snippet demonstrates several key enhancements for optimizing image display
                    and responsiveness on webpages. These enhancements focus on improving the visual presentation
                    and user experience across different devices and screen sizes.

                </section>

                <section class="rsv">
                    <input type="checkbox" id="rsv">
                    <label for="rsv">Details</label>
                    <section class="rsv-text">
                        <h4>Image Size and Aspect Ratio</h4>
                        <p>
                            The max-width property is applied to the <code>&lt;img&gt;</code> elements to ensure
                            that images never exceed their container's width. This prevents images from overflowing
                            or stretching beyond the viewport on smaller screens.
                        </p>

                        <!--Change hyperlink to be for last image on page-->
                        <p>
                            (Applied: <a href="jobs.php">jobs.php</a>, about.php)
                        </p>
                        <h4>Adjustable Font Sizes</h4>
                        <p>
                            Font sizes are defined in both relative units (em, rem), fixed pixel values and
                            <code>clamp()</code>. This allows text to adjust flexibly based on the viewport size,
                            improving readability on different devices.
                        </p>
                        <p>
                            (Applied: index.php, jobs.php, <a href="apply.php">apply.php</a>, about.php,
                            enhancements.php)
                        </p>

                        <h4>Flexbox</h4>
                        <p>
                            Flexbox properties (<code>display: flex</code>, <code>flex-direction: column</code>) are
                            used to create a flexible layout for the header and footer sections, allowing their contents
                            to adapt to different screen sizes.
                        </p>
                        <p>
                            (Applied: index.php, <a href="jobs.php">jobs.php</a>)
                        </p>

                        <h4>Margin and Padding</h4>
                        <p>
                            Margin and padding properties may be adjusted to ensure appropriate spacing between
                            images and surrounding elements, optimizing layout and visual balance.
                        </p>
                        <p>
                            (Applied: <a href="index.php">index.php</a>, jobs.php, apply.php, about.php)
                        </p>

                        <h4>Media Queries</h4>
                        <p>
                            Media queries are used to adjust image size, styling, and layout based on the screen
                            size and device orientation. In our code, media queries are targeting different screen
                            widths such as @media (max-width: 668px), @media (max-width: 450px) and @media (max-width:
                            930px).
                        </p>
                        <p>
                            (Applied: jobs.php, apply.php, <a href="about.php"> about.php</a>, enhancements.php)
                        </p>

                    </section>
                </section>
            </section>
        </section>
        </section>
        </section>

        <section class="googlemap">
            <section id="googlemap">
                <h2 class="title"> Google Maps Integration</h2>
                <section class="map-sum">
                    The php code snippet demonstrates an enhancement of effectiveness, in that it makes it quick
                    and intuitive for the user to find not only the location of the business, but its location in
                    relation to other places.
                </section>

                <section class="map">
                    <input type="checkbox" id="map">
                    <label for="map">Details</label>
                    <section class="map-text">
                        <h4>Google Maps Window</h4>
                        <p>
                            This code uses an i-frame to embed a hyperlink to the Google Maps website. The map
                            appears as an interactive window within the page and defaults to viewing the business
                            location. The user can easily change what the map views to see other important sites
                            near the business.
                        </p>

                        <p>
                            (Applied: <a href="index.php#enhancement1">index.php</a>)
                        </p>
                    </section>
                </section>
            </section>
        </section>

        <?php include 'footer.inc'; ?>

    </body>

</php>