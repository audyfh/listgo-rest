function submitCategory() {
      const name = document.getElementById("create-input").value.trim();
      if (name === "") {
        alert("Please enter a category name.");
        return;
      }

      fetch("index.php?c=Category&m=addCategory", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "name=" + encodeURIComponent(name)
      })
      .then(res => res.text())
      .then(data => {
        console.log("Response:", data);
        document.getElementById("popup-modal").classList.add("hidden");
        location.reload();
      })
      .catch(err => console.error("Fetch error:", err));
    }