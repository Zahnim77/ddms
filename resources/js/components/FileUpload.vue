<template></template>

<script>
export default {
  name: "file-upload",
  imagePreview: null,
  showPreview: false,

  data() {
    return {
      formFields: {
        name: null,
        avatar: null,
      },
      formData: null
    };
  },

  onFileChange(event) {

    /*
    Set the local file variable to what the user has selected.
    */
    this.formFields.avatar = event.target.files[0];
    /*
    Initialize a File Reader object
    */
    let reader = new FileReader();

    /*
    Add an event listener to the reader that when the file
    has been loaded, we flag the show preview as true and set the
    image to be what was read from the reader.
    */
    reader.addEventListener(
      "load",
      function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
      }.bind(this),
      false
    );

    /*
    Check to see if the file is not empty.
    */
    if (this.formData.avatar) {
      /*
            Ensure the file is an image file.
        */
      if (/\.(jpe?g|png|gif)$/i.test(this.formData.avatar.name)) {
        console.log("here");
        /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
        reader.readAsDataURL(this.formData.avatar);
      }
    }
  },

  submitForm() {
    let formData = new FormData();

    formData.append("avatar", this.formFields.avatar);
    formData.append("name", this.formFields.name);

    axios
      .post("update.profile", formData1)
      .then((res) => {
        console.log(res);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>