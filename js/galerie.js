var grids = document.querySelectorAll('.grid');

grids.forEach(function(grid) {
    new Masonry(grid, {
        itemSelector: '.grid-item',
        columnWidth: 180,
        gutter: 10
    });
});
