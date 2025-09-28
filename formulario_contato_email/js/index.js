    function sendEmail() {
      // getting values from inputs
      let email_author = document.getElementById("email_author").value;
      let email_title = document.getElementById("email_title").value;
      let email_body = document.getElementById("email_body").value;

      // email body
      let body = `Hi! I am ${email_author}%0D%0A${email_body}%0D%0AThanks for your attention, ${email_author}`;
      // %0D%0A = quebra de linha no mailto

      let email = "marcelohenrique.github@gmail.com";
      let assunto = `${email_title}`;
      let link = `mailto:${email}?subject=${encodeURIComponent(assunto)}&body=${body}`;

      window.location.href = link;
    }