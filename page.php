<?php get_header(); ?>

<main class="single-page">
<?php
if (have_posts ()) {
  while(have_posts()) : the_post();
?>


<?php the_title(); ?>

<?php the_content (); ?>

<?php endwhile; } ?>

</main>
<script defer> 
document.querySelector("input[control-id='ControlID-19']").addEventListener("click", function() {
        if(document.querySelector("input[control-id='ControlID-19']").checked) {
            document.querySelector("#billing_wooccm18_field").setAttribute("style", "display:block !important;");
        } else {
            document.querySelector("#billing_wooccm18_field").setAttribute("style", "display:none !important;");
        }
    }) 

    document.querySelector("#billing_wooccm17").addEventListener("click", function() {
        if(document.querySelector("#billing_wooccm17").value === "Other") {
            document.querySelector("#billing_wooccm19_field").setAttribute("style", "display: block !important;")
        } else {
            document.querySelector("#billing_wooccm19_field").setAttribute("style", "display: none !important;")
        }
    })
    </script>