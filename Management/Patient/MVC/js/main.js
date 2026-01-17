(function () {
  const chip = document.querySelector('.userchip');
  const dd = document.querySelector('.dropdown');
  if (chip && dd) {
    chip.addEventListener('click', function () {
      dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function (e) {
      if (!chip.contains(e.target) && !dd.contains(e.target)) dd.style.display = 'none';
    });
  }
})();
