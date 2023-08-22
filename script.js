var acc = document.getElementsByClassName("accordion");

for (var i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}


function openModal(imgSrc) {
  const modal = document.getElementById('imageModal');
  const modalImg = document.getElementById('img01');

  modalImg.src = imgSrc;
  modal.style.display = "flex";
  setTimeout(() => {
      modal.style.opacity = "1";
  }, 10);
}

function closeModal() {
  const modal = document.getElementById('imageModal');
  modal.style.opacity = "0";
  setTimeout(() => {
      modal.style.display = "none";
  }, 300);
}

document.querySelectorAll('.project-container img').forEach(img => {
  img.addEventListener('click', function() {
      openModal(this.src);
  });
});
