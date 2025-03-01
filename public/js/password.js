try {
    let $btn = document.querySelector("#togglePassword")
    
    $btn.addEventListener("click", function() {
        let $password = document.querySelector("#password")
        if ($password.type === "password") {
            $password.type = "text"
            $btn.querySelector("i").classList.remove("bi-eye-slash-fill")
            $btn.querySelector("i").classList.add("bi-eye-fill")
        } else {
            $password.type = "password"
            $btn.querySelector("i").classList.remove("bi-eye-fill")
            $btn.querySelector("i").classList.add("bi-eye-slash-fill")
        }
    })
    
    // Cuando se haga click en input de password se hará foco (shadow azul)
    let $password = document.querySelector("#password")
    
    $password.addEventListener("focus", function() {
        let $formGroup = this.parentElement
        $formGroup.classList.remove("input-group")
        $formGroup.classList.add("input-group-selected")
    })
    
    // quitar foco
    $password.addEventListener("blur", function() {
        let $formGroup = this.parentElement
        $formGroup.classList.remove("input-group-selected")
        $formGroup.classList.add("input-group")
    })
} catch (error) {
    // pass   
}
