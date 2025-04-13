document.addEventListener("DOMContentLoaded", () => {
    const logBox = document.querySelector("#login-box")
    const regBox = document.querySelector("#register-box")


    const errorDivsForReg = document.querySelectorAll("#register-box .errors");
    const errorDivsForLog = document.querySelectorAll("#login-box .errors");

    const logBoxBtn = document.querySelector("#login-box button")
    const regBoxBtn = document.querySelector("#register-box button")
    document.querySelector("#login-btn-change").addEventListener("click", () => {
        logBox.style.display = "block";
        regBox.style.display = "none"
    })
    document.querySelector("#register-btn-change").addEventListener("click", () => {
        logBox.style.display = "none";
        regBox.style.display = "block"
    })

    logBoxBtn.addEventListener("click", (e) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget.parentElement);

        errorDivsForLog.forEach(error => {
            error.textContent = ""
        })

        fetch("/project-gallery/src/controller/loginController.php", {
            method: "post",
            body: formData
        })
            .then((res) => {
                res.json()
                    .then(data => {
                        const errors = data.errors;
                        if (data === "success") {
                           window.location.href = "/project-gallery/home"
                        }
                        else {
                            if (data.error) {
                                console.log(data);
                                alert(data.error);
                            }
                            else {
                                errors.forEach((element) => {
                                    if (element.startsWith("Username")) {
                                        errorDivsForLog[0].textContent = element
                                    }
                                    else {
                                        errorDivsForLog[1].textContent = element
                                    }
                                    console.log(element);

                                });
                            }
                        }
                    })
            })



    })

    regBoxBtn.addEventListener("click", (e) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget.parentElement);

        errorDivsForReg.forEach(error => {
            error.textContent = ""
        })

        fetch("/project-gallery/src/controller/registerController.php", {
            method: "post",
            body: formData
        })
            .then((res) => {
                res.json()
                    .then(data => {
                        const errors = data.errors;
                        if (data === "success") {
                            window.location.href = "/project-gallery/home"
                        }
                        else {
                            if (data.error) {
                                console.log(data);
                                alert(data.error);
                            }
                            else {
                                errors.forEach((element) => {
                                    if (element.startsWith("Username")) {
                                        errorDivsForReg[0].textContent = element
                                    }
                                    else if (element.endsWith("match")) {
                                        errorDivsForReg[2].textContent = element
                                    }
                                    else {
                                        errorDivsForReg[1].textContent = element
                                    }
                                    console.log(element);

                                });
                            }
                        }
                    })

            })

    })
})