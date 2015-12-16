# SESE ZenCart Bootstrap Theme

This is a ZenCart Theme for Southern Exposure Seed Exchange, using Bootstrap
v3.3.6.

## Install

Install the theme by running `install.sh`. This will create symbolic links from
your ZenCart installation to the appropriate directories in the `theme` folder:

```
./install.sh /path/to/my/zencart-root-folder
```

## Build

The final CSS is generated from Bootstrap's SCSS source files and our custom
SASS files. The CSS is generated using `scss` and the commands are organized
using `make`. To watch the SASS files for changes & automatically compile new
CSS files, simply run `make`. To only build them once, run `make build`. To
build compressed CSS files for distribution, run `make dist`.


## Notes

Some of ZenCart's default functionality has been changed in this theme:

* Removed all Banners. Any Banners added via ZenCart's Admin will not show up.
* There is no left column. Instead, any sideboxes set to display in the left
  column will take up 1/3 of a row in the footer.
