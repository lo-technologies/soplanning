SO Planning - Readme
==================

    http://soplanning.sourceforge.net

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 3,
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

---------------------------

v1.32

- Many small fixes coming for SOPlanning users, thanks to all
- Active directory support (experimental)

v1.31

- new planning display : now possible to display per day with hour slots !
- new funny tool to select project and user when creating task
- fields order changed in task form, for a better experience
- Many small bug fixes due to the new layout
- added sortable option in project list
- Drag and drop fixed
- Norwegian public holidays added, thanks to Kai
- Bug fix for gantt chart on recent PHP version

v1.30

- Design updates : thanks to Sebastien who reviewed all interfaces and applied the same design everywhere. Not a big visual impact, but more flexible and more compatible design !
- auto-installer/upgrade system added. No file modification needed anymore, the interface will help for initial setup or upgrade to a new version.
- Session isolation : you can now install 2 SOPlanning instances on the same url (with 2 differents databases), sessions will not be shared. You will be able to browse both instances.
- Contact form for easier communication with support.
- Planning options (date, months display, etc) are now kept in cookies and restored at your next login.
- added an option in the planning to display the total time per day

v1.29

- Major update on DE translation (thanks to contributors)
- full text search now search also on task title
- Added teams and project groups on the PDF export (only displayed in the planning previously)
- left column on the planning : added link on objects (users or projects) to open directly the popup window.
- Top menu now compatible with Mobile/tablet : click on the menus will open sub-menus
- Bug fix on project deletion (specific rights).
- Email notification when moving a task (drag and drop).
- "Sort by" choice is now stored in cookie, to keep the same preference at next login.
- Modified summary table below the planning : if the planning is displayed by user, now also displays the summary table grouped by user. Same thing for project. Till now, only display by project was available.
- Added small features to send a test email with the setup done. Allow to test easily if it works.
- Bug fixed on total time calculation (when more than 100 hours cumulated)
- Fix on email sending, for task creation. New help text for SMTP setup.
- Date calculation improved on recurring tasks : now escape days off AND go back to the original day for next weeks/months.

v1.28

- Update on planning menu, more "fluid" with smaller screens.
- Bug fix on Firefox and IE : buttons didn't work in the planning (print, export, etc).
- Bug fix on date picker, specific characters incorrectly displayed
- Changed display of links in tasks, and add automatically http://

v1.27
- Small fixes
- New feature to limit assignment to one task per user per day.
- added task creator name on the planning. Displayed when mouse is over the task.
- Added sorting option : can now sort the planning by name (project or user), id, team, group of project. If team or group, their name is also displayed as a separator in the planning.
- Added new option to display planning header (months/days) every x lines.
- Added milestone : can create a task as a milestone, displayed with specific icon in the planning. Also added to Gantt export.
- Added task status : to do, in progress, done, abandoned. Done and abandoned tasks are displayed crossed
- Added also a filter in the planning to display only status selected.
- Added repetition information in the email notification
- Fix bug on task creation : end repetition datepicker was never closed
- Dropdown added on title field when creating a task, in order to display existing titles for the same project.

v1.26

- email notification on task creation/modification/deletion
- improved project list, display all or filter by date
- now possible to send email to new user created to let them modify their password
- the planning is now exactly limited on one month (it was before 1 month + 1 day)
- project charge added on the summary under the planning
- filtered project list displayed on task creation/modification (only active/todo projects displayed)
- fixed XSS issues
- some new security fixes
- added new user right to let him view all people in his team
- can now close opened window (task creation, project creation, etc) with ESC key

v1.25

- Added public holidays import module for several countries
- new PDF calendar export (condensed view)
- Minor fixes on new design
- Some Security upgrades

v1.24

- New full layout !
- Added portuguese and spanish languages
- Added project color in the planning column, and today highlight.

v1.23

- overlapping periods are now displayed perfectly : cells stay on the same line instead
- added groups of users, with ability to filter planning on those groups
- excluded days off and public holidays from the repetition feature

v1.22

- Bug fix on project creation for users with limited rights
- added half day displayed differently in the planning
- added task title : display in mouseover on the planning, and in Gantt export
- added ICAL export (for calendar sync)
- Minutes management in task duration
- added days off management
- small fixes

v1.21

- added "repeat task" feature : daily, weekly, monthly
- fix on user self modification
- Fix on drag and drop when planning is inverted (displayed by project)
- Changed users rights for finer management
- added color management for users => better view in planning when displayed by projects
- some minor fixes coming from users

v1.20
- added Gantt export
- added email field to user profile
- added interface to allow user to change own email and password
- added password recovery feature
- added option to setup the SMTP parameters
- added an url for the SOPlanning instance, for email links
- added option to change SOPlanning name
- replaced "notes" field in a task assigned by a multi-lines input field
- replaced the old color picker
- password are now crypted in the database (sha1)
- fixed accent bug on PDF export
- fixed display bug with "hide empty lines" feature
- fixed when moving a task, the duration is conserved
- fix on months and days translation
- project identifier size extended to 10 cars
- user identifier size extended to 10 cars
- added text filter in the planning view

v1.19
- Check on read/write of important directories
- Deported all config.inc variables in option page (now editable in Soplanning interface)
- add "hide empty line" feature in the planning
- Bug fix on printable version
- Bug fix on CSV export
- Bug fix on drag n drop feature
- Bug fix in database auto upgrade

v1.18
- New overall look and feel
- PHP version check (>= 5.2)
- Database auto-updater for new releases
- Changed default line height in the planning (fits to assignment cells)
- separate rights between admin and planers : admin : all rights (project management / users / planning modification). Planner : can create projects, modify/delete his own projects, assign tasks to his projects. No access to users management.Read only : no modification right, can only view planning.
- paging added to the planning, to limit number of lines displayed
- PDF export

v1.17
- planning view : move/copy option on drag and drop

v1.16
- code rewriting (date management review) => gain x10 in planning view
- somes fixes on planning filters and version check
- Fix on SQL import file

v1.15
- Code rewrite
- Fix on version check (Chrome and display improved)
- Minor fixes

v1.14
- added duplicate button for period
- allow period copy on existing period (as for creation)
- Added online version check
- fixed language detection in firefox
- fixed filter window positionning
- Can now change filter display (number or users / projects per column)
- Better refresh management (not after each window closing, etc)
- Easier to integrate in other links

v1.13
- Fixed filters on planning (position and filter kept when changing date)
- fixed language management on dates for some platforms.

v1.12
- Minor fixes
- Many display improvements
- Planning displayed now in a scrolling layer, without moving other menus
- added options submenu

v1.11
- End date copied from start date when empty
- http link added to period. DON'T FORGET TO RUN /upgrade/1-11.sql
- in planning view, users ordered by name (no longer by user id)
- in planning view, tasks ordered by start date in the bottom projects table
- fixed week display in specific case
- groups of projects added to the planning filter

v1.10
- Add CSV Export functionnality
- Repeat days in table every 10 users
- Add postgresql support
- Add ldap login support
- Add NL translation

