<style>
     body {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    body.loaded {
      opacity: 1;
      transform: translateY(0px);
    }

    body.fade-out {
      opacity: 0;
      transform: translateY(-20px);
      transition: opacity 0.4s ease, transform 0.4s ease;
    }
</style>

<script>
    window.addEventListener("load", () => {
      document.body.classList.add("loaded");
    });

    document.querySelectorAll("a").forEach(link => {
      link.addEventListener("click", function(e) {
        e.preventDefault();
        let href = this.getAttribute("href");

        document.body.classList.add("fade-out");

        setTimeout(() => {
          window.location.href = href;
        }, 400);
      });
    });
</script>