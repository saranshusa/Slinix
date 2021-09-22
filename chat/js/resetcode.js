const form = document.querySelector("form"),
  continueBtn = form.querySelector(".login100-form-btn"),
  successText = form.querySelector(".code-sent"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/resetcode.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "Success! Code sent to your email address") {
          errorText.textContent = data;
          errorText.style.display = "block";
          successText.style.display = "none";
          //location.href = "index.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
