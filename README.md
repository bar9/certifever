Certifever
==========

a future web app for practicing programming certifications
but also a tutorial for symfony / bolt cms / storybook / daisy ui

## prerequisites
* php & composer
* node & yarn

## step 1 (`git checkout step1` to skip most of this)
* `composer create-project bolt/project certifever`
* `cd certifever`
* `git init`
* `npx gitignore symfony`
* `git add .`
* `git commit -m "default bolt installation"`
* Create a github repository
* `git remote add origin https://github.com/<<youruser>>/certifever.git`
* `git branch -M main`
* `git push -u origin main`
* `composer require bar9/bolt-theme-skeleton`
* `bin/console bolt:copy-themes`
* `bin/console server:start`
* open 127.0.0.1:8000/bolt in yor browser
* edit `index.twig`, `partials/_layout.twig` and `config/bolt/config.yaml` according to *step1*
* in the `public/theme/bolt-theme-skeleton` dir: `yarn`
* `npx tailwindcss -i ./css/input.css -o ./css/output.css`
At this point, you should see a styled output of a welcome page.
