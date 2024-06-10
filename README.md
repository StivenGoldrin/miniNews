Description of Practical Assignment “News Aggregator”

Team of Developers
--------------------------------------------------------
There is one student participating in the development of the system:
- Stivens Goļdrins, sg23054 (design, business logic development, user interface design,
programming of controllers and models)

Development Environment
--------------------------------------------------------
It is planned to develop the system in PHP 8.2 environment using Laravel 11 library. It is planned
to use MySQL database for data storage. The code will be stored in the GitHub system.

Main Functionality
--------------------------------------------------------
Within the framework of the practical assignment, it is planned to develop a news aggregation
system. Visitors will be able to register as users and get access to news data and articles.
Registered admins will be able to post, delete and edit categories. The system will fetch news
articles from various sources using a news API or RSS feeds and store these articles in the
database for quick access.

Data Registry
--------------------------------------------------------
The system consists of categories that can be added, deleted, and edited by the administrator. Each
category consists of fetched and stored news articles for quick access. Registered user will be
able to select category and then see and read relevant articles. Each user will have stored
preferences.

MVC
--------------------------------------------------------
The system will be implemented following an MVC paradigm. The system will be distributed into
the following components:

Models:

- User,
- Category,
- Article,
- Preferences.
  
Views:

- list of news articles that also on top displays category selections,
- view with information about a particular news article,
- new category creation view,
- category deletion view,
- view for registering users,
- view for editing account settings/preferences.
  
Controllers:

- AdminCategoryController with methods for retrieving and showing a list of categories
(index), creating (create), saving (store), editing (edit) and saving changes in the
database (update), deleting (delete) a new category.
- ArticleController with methods for retrieving and showing a list of articles in a category
(index).
- Laravel standard RegisterController and LoginController.
- Translatecontroller with a function that takes the text to be translated and the target
language as parameters. This function should make a request to the translation API and
return the translated text.
- ArticleFetchController with a function that fetches and stores news articles in a
database with the help of API.

User Roles
--------------------------------------------------------
The system supports 2 different user roles - a registered user and administrator. Each of these
roles have different operations available in the system.
Registered user:
- Gets an ability to access all available news articles.
- Can change profile settings/preferences.
Administrator:
- Can do everything that registered user can do.
- Can add, edit and delete news article categories.
  
User Authentication
--------------------------------------------------------
For the user authentication, it is only possible to use a local registration system.

System Interface
--------------------------------------------------------
The image shows the form for category displaying. User can select an article, expand, and read
it. It is also possible to select another category, change language and access account
settings/preferences by clicking on a question mark.
