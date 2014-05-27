# CodeForge
CodeForge is a framework for quick web development.

## Third-Party Packages
**The following open source packages are included in this framework:**
- [BootStrap](https://github.com/twbs/bootstrap) v3.1.1
- [Ratchet](https://github.com/twbs/ratchet) v2.0.2
- [CodeIgniter](https://github.com/EllisLab/CodeIgniter) v2.1.4

**The following open source packages are referenced in this framework:**
- [jQuery](https://github.com/jquery/jquery) v1.11.0

**The following packages are restricted in this framework*:**
- [Glober](http://fontfabric.com/glober-free-font/)
- [Glyphish](http://www.glyphish.com) 6 & 7
- [SS Glyphish](http://symbolset.com/icons/glyphish)
- [SS Social](http://symbolset.com/icons/social-regular)
These packages are only included if you have a license for the packages.
If you have a license for any of these packages and they are not included, you can include them manually.

## Compiling Source
CodeForge uses [Node](http://nodejs.org), [NPM](https://www.npmjs.org) and [Grunt](http://gruntjs.com) with convenient methods for working with the framework.

### Install Node, NPM & Grunt
1. Download and install [Node](http://nodejs.org)
From the command line:
2. Run `sudo npm install -g grunt-cli`
3. `cd` to the CodeForge directory, then run `npm install`
NPM will automatically install the necessary local dependencies listed there.

### Available Commands

#### Build - `grunt`
Run `grunt` to compile the source into `build`.

#### Reset - `grunt reset`
Run `grunt reset` to clean all builds, you will have to re-run the build again.