<div class="row col-12">
    <div class="col-3">

    </div>
    <div class="col-6 mt-4">
        <center>
            <div>
                <button class="btn background-secondary radius text-white ">Add Video</button>
                <button class="btn background-secondary radius text-white ms-5">Remove Video</button>
            </div>
        </center>
        <div class=" mt-4 card-body background-light">
            <center> <span class="text-sec-color"><b>Choose a Skill</b></span></center>
            <div class=" mt-2">
                <label for="sub-category">Sub Category <span class="important">*</span></label>
                <select name="sub_category" class="form-control " id="sub-category">
                    <option value="" disabled selected>Select One</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
            <div class="mt-3">
                <label for="skill">Skill <span class="important">*</span></label>
                <select name="skill" class="form-control" id="skill">
                    <option value="" disabled selected>Select One</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>


            <div class="mt-3">
                <label for="video-file">Upload Video/Link <span class="important">*</span></label>
                <input type="file" name="video_file" accept="video/*" class="form-control" id="video-file">
            </div>
            <div class="mt-4 ">
                <center> <button class="btn background-secondary  text-white" type="submit">Proceed</button>
                </center>
            </div>
        </div>
    </div>
</div>
