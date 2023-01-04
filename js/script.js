$(document).ready(() => {
    // function toggle password
    function showPass() {
        $(".ic-eye").on("click", () => {
            $(".ic-eye").toggleClass("bi-eye-slash-fill bi-eye-fill");
            $("#password").attr("type", function () {
                return $(this).attr("type") === "password" ? "text" : "password";
            })
        })
    }

    // Main Function
    function main() {
        showPass();

        // TAG INPUT PADA FORM SISWA:
        // tambah attr required, set ke true
        // tambah attr autocomplete, set ke off
        $("#form-siswa input").each(function () {
            $(this).attr("required", true);
            $(this).attr("autocomplete", "off");
        })


    }
    main();
})