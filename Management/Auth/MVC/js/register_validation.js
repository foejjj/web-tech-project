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

  // ✅ Password must contain: lower, upper, digit, special, min 8
  function isStrongPassword(pw) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/.test(pw);
  }

  // ✅ Name: letters + spaces, min 3
  function validName(n) {
    return /^[A-Za-z\s]{3,}$/.test(n);
  }

  // ✅ Email format
  function validEmail(e) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e);
  }

  // ✅ BD phone basic: 01 + 9 digits
  function validPhone(p) {
    return /^01\d{9}$/.test(p);
  }

  // Show/Hide doctor specialization
  role.addEventListener("change", () => {
    doctorBox.style.display = (role.value === "doctor") ? "block" : "none";
    hideMsg();
  });

  // 🔥 AJAX Email Uniqueness Check (JSON)
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

  // Local DOM validation (Name/Password/Confirm/etc.)
  function localValidate() {
    const roleVal = role.value.trim();
    const name = nameEl.value.trim();
    const email = emailEl.value.trim();
    const phone = phoneEl.value.trim();
    const dob = dobEl.value;
    const gender = genderEl.value;
    const pass = passEl.value;
    const cpass = confirmEl.value;

    if (!roleVal) return { ok: false, msg: "Please select role." };
    if (!validName(name)) return { ok: false, msg: "Name must be 3+ letters (A-Z) and spaces only." };
    if (!validEmail(email)) return { ok: false, msg: "Invalid email format." };
    if (!validPhone(phone)) return { ok: false, msg: "Phone must be 11 digits and start with 01." };
    if (!dob) return { ok: false, msg: "Please select Date of Birth." };
    if (!gender) return { ok: false, msg: "Please select Gender." };

    if (!isStrongPassword(pass)) {
      return { ok: false, msg: "Password must be 8+ chars with uppercase, lowercase, number & special character." };
    }
    if (pass !== cpass) return { ok: false, msg: "Passwords do not match." };

    if (roleVal === "doctor") {
      const sp = (specEl?.value || "").trim();
      if (sp.length < 2) return { ok: false, msg: "Doctor specialization is required." };
    }

    return { ok: true, msg: "" };
  }

  // Live validation while typing
  ["input", "change"].forEach(evt => {
    form.addEventListener(evt, () => {
      const v = localValidate();
      if (!v.ok) {
        showMsg("error", v.msg);
        submitBtn.disabled = true;
      } else {
        hideMsg();
        // email uniqueness will enable/disable too; here just allow if local ok
        submitBtn.disabled = false;
      }
    });
  });

  // Final submit check
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const v = localValidate();
    if (!v.ok) {
      showMsg("error", v.msg);
      submitBtn.disabled = true;
      return;
    }
    form.submit();
  });
});
