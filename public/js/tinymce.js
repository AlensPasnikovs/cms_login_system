function initTinyMCE(selector) {
    const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;
    tinymce.init({
        selector: selector,
        plugins:
            "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",
        editimage_cors_hosts: ["picsum.photos"],
        menubar: "file edit view insert format tools table help",
        toolbar:
            "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | align | numlist bullist outdent indent | link image media table anchor codesample | fullscreen | forecolor backcolor removeformat | charmap emoticons | ltr rtl | pagebreak ",
        quickbars_insert_toolbar: false,
        toolbar_sticky_offset: isSmallScreen ? 102 : 108,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,

        height: 600,
        image_caption: true,

        contextmenu: "link image table",

        quickbars_selection_toolbar:
            "bold italic | quicklink h2 h3 blockquote quicktable",
        link_target_list: false,
        toolbar_mode: "wrap",
        importcss_append: true,
        //skin based on localStorage.getItem("theme") if dark then dark if light then light
        skin: localStorage.getItem("theme") === "dark" ? "oxide-dark" : "oxide",

        content_css:
            localStorage.getItem("theme") === "dark" ? "dark" : "default",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
        setup: function (editor) {
            editor.on("keyup", function () {
                var textareaId = editor.id;
                if (tinymce.get(textareaId).getContent() != "") {
                    $("#" + textareaId)
                        .siblings(".post_content")
                        .css("display", "none");
                } else {
                    $("#" + textareaId)
                        .siblings(".post_content")
                        .css("display", "block");
                }
            });
        },
    });
}

jQuery(function () {
    initTinyMCE("#create_post_content");
    initTinyMCE("#update_post_content");

    $("#toggle-theme").on("click", function () {
        tinymce.remove("#create_post_content, #update_post_content");
        initTinyMCE("#create_post_content");
        initTinyMCE("#update_post_content");
    });

    document.addEventListener("focusin", function (e) {
        if (
            e.target.closest(
                ".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root"
            ) !== null
        ) {
            e.stopImmediatePropagation();
        }
    });

    $(".post_delete_form").on("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            background:
                localStorage.getItem("theme") === "dark" ? "#1e1e1e" : "",
            //text color
            color: localStorage.getItem("theme") === "dark" ? "#ADB5BD" : "",
            title: translations.delete_confirmation_title,
            text: translations.delete_confirmation_text,
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: translations.delete_confirm,
            cancelButtonText: translations.cancel,
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).unbind();
                $(this).submit();
                console.log("clicked");
            } else {
                console.log("not clicked");
            }
        });
    });

    var forms = $(".needs-validation");
    forms.each(function () {
        $(this).on("submit", function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $(".loadingSpan").attr("hidden", false);
                $(".btnSave").attr("disabled", true);
                $(".loadingText").text(translations.save_loading_text);
                console.log("form is valid");
            }
            $(this).addClass("was-validated");
        });
    });

    var update_action = $("#update_post_form").attr("action");
    $("#create_post_modal, #edit_post_modal").on(
        "hidden.bs.modal",
        function () {
            $(".loadingSpan").attr("hidden", true);
            $(".btnSave").attr("disabled", false);
            $(".loadingText").text(translations.save);
            $("#update_post_form").attr("action", update_action);
        }
    );
    $("#edit_post_modal").on("hidden.bs.modal", function () {
        //reset form
        $("#update_post_form").trigger("reset");
        $("#update_post_form").removeClass("was-validated");
    });
    $("#edit_post_modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var post_id = button.data("post-id");
        $("#update_post_form").attr("action", update_action + "/" + post_id);
        $("#update_post_title").prop("disabled", true);
        tinymce.activeEditor.mode.set("readonly");
        $("#update_post_image").prop("disabled", true);
        // Call the function to get the post data
        $.ajax({
            type: "GET",
            url: "/post/edit/" + post_id,
            success: function (response) {
                // Set the values in the form fields
                $("#update_post_title").val(response.title);
                tinymce.get("update_post_content").setContent(response.content);
                // Show the post image name
                $("#update_post_image_label").text(response.image);

                $("#update_post_title").prop("disabled", false);
                tinymce.activeEditor.mode.set("design");
                $("#update_post_image").prop("disabled", false);
            },
        });
    });

    $("#create_post_image, #update_post_image").change(function () {
        let fileName =
            this.files.length > 0 ? this.files[0].name : "choose_file_not";
        $(`#${this.id}_label`).text(fileName);
    });
});
