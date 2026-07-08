// document.addEventListener('DOMContentLoaded', function () {
//     const galleryItems = document.querySelectorAll('.gallery__item');
//     const contentSections = document.querySelectorAll('.gallery__content');

//     // Activate first tab and content by default
//     function activateTab(item) {
//       const targetId = item.getAttribute('data-target');

//       // Remove active class from all tabs and contents
//       galleryItems.forEach(i => i.classList.remove('active'));
//       contentSections.forEach(section => section.classList.remove('active'));

//       // Activate selected tab and content
//       item.classList.add('active');
//       document.getElementById(targetId).classList.add('active');
//     }

//     // Add click events to all tabs
//     galleryItems.forEach(item => {
//       item.addEventListener('click', () => {
//         activateTab(item);
//       });
//     });

//     // Trigger the first tab on load
//     if (galleryItems.length > 0) {
//       activateTab(galleryItems[0]);
//     }
//   });
document.addEventListener('DOMContentLoaded', function () {
  const galleryItems = document.querySelectorAll('.gallery__item');
  const contentSections = document.querySelectorAll('.gallery__content');

  function activateTab(item, scrollToContent = false) {
    const targetId = item.getAttribute('data-target');

    galleryItems.forEach(i => i.classList.remove('active'));
    contentSections.forEach(section => section.classList.remove('active'));

    item.classList.add('active');
    const targetContent = document.getElementById(targetId);
    targetContent.classList.add('active');

    if (scrollToContent) {
      targetContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  galleryItems.forEach(item => {
    item.addEventListener('click', () => {
      activateTab(item, true);
    });
  });

  if (galleryItems.length > 0) {
    activateTab(galleryItems[0]);
  }
});
  const backToTopBtn = document.getElementById("backToTopBtn");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      backToTopBtn.style.display = "flex"; 
    } else {
      backToTopBtn.style.display = "none"; 
    }
  });

  backToTopBtn.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });