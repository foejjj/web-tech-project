document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("regForm");
  const role = document.getElementById("role");
  const doctorBox = document.getElementById("doctorBox");

  const nameEl = document.getElementById("name");
  const emailEl = document.getElementById("email");
  const phoneEl = document.getElementById("phone");
  const dobEl = document.getElementById("dob");
  const genderEl = document.getElementById("gender");
  const passEl = document.getElementById("password");
  const confirmEl = document.getElementById("confirm_password");
  const specEl = document.getElementById("specialization");

  const liveMsg = document.getElementById("liveMsg");
  const submitBtn = document.getElementById("submitBtn");

  function showMsg(type, text) {
    liveMsg.style.display = "block";
    liveMsg.className = "alert " + (type === "success" ? "success" : "error");
    liveMsg.textContent = text;
  }
  function hideMsg() {
    liveMsg.style.display = "none";
    liveMsg.textContent = "";
  }

  function isStrongPassword(pw) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/.test(pw);
  }
  function validName(n) {
    return /^[A-Za-z\s]{3,}$/.test(n);
  }

  function validEmail(e) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e);
  }

  function validPhone(p) {
    return /^01\d{9}$/.test(p);
  }

  role.addEventListener("change", () => {
    doctorBox.style.display = (role.value === "doctor") ? "block" : "none";
    hideMsg();
  });

  let emailTimer = null;
  emailEl.addEventListener("input", () => {
    hideMsg();
    submitBtn.disabled = true;

    clearTimeout(emailTimer);
    emailTimer = setTimeout(() => {
      const email = emailEl.value.trim();

      if (!email) return;
      if (!validEmail(email)) {
        showMsg("error", "Invalid email format.");
        return;
      }

      fetch("../php/validate_registration.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "check_email", email })
      })
        .then(r => r.json())
        .then(data => {
          if (!data.ok) {
            showMsg("error", data.message || "Email already exists.");
            submitBtn.disabled = true;
          } else {
            hideMsg();
            submitBtn.disabled = false;
          }
        })
        .catch(() => {
          showMsg("error", "Server error while checking email.");
          submitBtn.disabled = true;
        });
    }, 450);
  });
