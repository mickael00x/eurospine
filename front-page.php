<?php get_header(); ?>

<main class="homepage">
    <h2>Are you a EUROSPINE member?</h2>
    <div class="input-box">
        <div class="yes-no-inputs">
            <div class="input-group">
                <input type="radio" class="input-homepage" id="input-homepage-yes" name="input-homepage">
                <label class="label-homepage" for="input-homepage-yes">Yes</label>
            </div>
            <div class="input-group">
                <input type="radio" class="input-homepage" id="input-homepage-no" name="input-homepage">
                <label class="label-homepage" for="input-homepage-no">No</label>
            </div>
        </div>
        
        <div class="inputs-validation">
            <input type="text" id="input-validation" placeholder="Enter member discount code here  " name="input-validation">
            <button type="button" id="input-button">Submit</button>
        </div>
        <div class="inputs-validation-infos">
            <p>
            You are eligible to receive a discount code if you are members in good standing of EUROSPINE. <br>
            In other words, you must have paid the EUROSPINE membership fees for 2022.  <br>
            <p>Membership fees can be paid online directly in your EUROSPINE <a href="https://www.m-anage.com/Home/Index/Society/EUROSPINE-MB/en-GB">membership account: </a> </p>
            If you have paid your 2022 membership fees and still have not received your discount code by email, please contact: <a href="mailto:membership@eurospine.org">membership@eurospine.org</a>
            </p>
        </div>
    </div>
</main>

