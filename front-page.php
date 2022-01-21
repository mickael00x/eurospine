<?php get_header(); ?>
<form id="form-homepage" action="#">
    <main class="homepage">
        <img class="eurospin-logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/EUROSPINE_FB.png" alt="logo_eurospine">
        <h1>June 2022 EduWeek registration</h1>
        <h2 class="txt-blue">Are you a EUROSPINE member?</h2>
        <div class="input-box">
            <div class="yes-no-inputs">
                <div class="input-group">
                    <input type="radio" class="input-homepage" id="input-homepage-yes" name="input-homepage" value=1>
                    <label class="label-homepage" for="input-homepage-yes">Yes</label>
                </div>
                <div class="input-group">
                    <input type="radio" class="input-homepage" id="input-homepage-no" name="input-homepage" value=0>
                    <label class="label-homepage" for="input-homepage-no">No</label>
                </div>
            </div>

            <div class="inputs-validation">
                <p class="txt-blue">If you have a coupon code, please apply it below.</p>
                <input type="text" id="input-validation" placeholder="Enter code" name="input-validation">
                <p class="invalid-code">Invalid Code</p>
                <p><button type="submit" id="input-button">Validate</button></p>
            </div>
            <div class="inputs-validation-infos">
                <p>Please note that, if you already are a EUROSPINE member and wish to take advantage of the EUROSPINE member discount when registering for the course, you must ensure you have settled your 2022 membership fee before starting your course registration. You can do this in your <a href="https://www.m-anage.com/Home/Index/Society/EUROSPINE-MB/en-GB">membership account</a>.</p>
                <p>Once your membership payment has been cleared by our accountant, the member discount code will be shared with you in your M-anage account under the tile “Resources”.</p>
                <p>Please note that we cannot reimburse the difference between the non-member and members registration fee if a member registers at the non-members rate.</p>
                <p>If you have paid your 2022 membership fees and still have not received your discount code by email, please contact: <a href="mailto:membership@eurospine.org">membership@eurospine.org</a></p>
            </div>
        </div>
    </main>
</form>