# Working on the site with Claude

How Katie designs and updates declaire.design. Katie owns the design and content, and Claude does the building. Matt reviews each change before it goes live.

**For Claude:** when Katie asks how to get started, or what to do next, walk her through the matching section below one step at a time. Keep it in plain language, and never ask her to run commands.

## One-time setup

Katie needs three things. Matt does step 2.

1. **A Claude account** on the Pro plan, on her personal email. Pro includes both Claude Design and Claude Code.
2. **Access to this repo.** Katie makes a free GitHub account and sends Matt her username. Matt adds her as a collaborator, and she accepts the invitation from her email. In GitHub, under **Settings** → **Emails**, she turns on **Keep my email addresses private**, because this repo is public.
3. **GitHub connected to Claude**, in two places:
    - In Claude: **Customize** → **Connectors** → **GitHub Integration** → **Connect**. This lets her Claude Design and chat sessions read this repo.
    - At claude.ai/code: follow the prompt to connect GitHub. This lets Claude make changes to the site.

### Optional: a Claude Project for the site

A Claude Project keeps the site's background in every chat, so Katie doesn't add it each time.

1. In Claude, create a project called "DeClaire Design website". Keep it unshared, because GitHub files can only be added to a private project.
2. In the project knowledge, click **+** → **GitHub**, choose `mattdeclaire/declaire.design`, and add the `brain` folder and `CLAUDE.md`. Re-sync them after the repo changes.
3. Set the project instructions to: *This project is for the DeClaire Design website. Follow CLAUDE.md and the brain folder. Start with brain/working-with-claude.md when I ask what to do next.*

If **Design** isn't offered as an output in a chat inside the project, start the design in a regular chat as described below.

## Designing the new look

Use Claude Design inside Claude. The older standalone site at claude.ai/design closes on December 14, 2026.

1. In Claude, start a new chat and choose **Design** as the output, or open the **Artifacts** tab and pick a Design template.
2. Click **+** → **Add from GitHub**, choose `mattdeclaire/declaire.design`, and add the `brain` folder and `CLAUDE.md`.
3. Attach 3 or 4 photos from each project you want to show, from your own computer or phone.
4. Send: *Please read brain/design-brief.md and the rest of the brain folder, then help me design the new DeClaire Design website. Start by asking me what I'd like it to feel like.*
5. Talk it through. Ask for phone and desktop versions.

When the design is right:

1. Ask Claude for the handoff spec described in [design-brief.md](design-brief.md).
2. Choose **Export** → **Handoff to Claude Code** → **Send to Claude Code Web**, and pick this repo if asked.
3. Claude builds it on a branch, shows screenshots and opens a pull request for Matt.

Nothing in Claude Design changes the live site, so experiment freely.

## Changing the live site

For anything after the redesign, such as a new project, new text or a color tweak:

1. Go to claude.ai/code and pick `mattdeclaire/declaire.design`.
2. Ask in plain words, for example "Add the Tahoe Cabin project with these photos" or "Make the accent a little warmer." Attach photos in the chat when a change needs them.
3. Claude follows [CLAUDE.md](../CLAUDE.md), shows screenshots at phone and desktop sizes, and opens a pull request.
4. Matt reviews and merges. The site updates a minute or two later.

## Good to know

- **Usage is shared.** Claude Design, chat and Claude Code use the same Pro allowance. Design work uses a lot of it. If she hits the limit, it resets after a few hours.
- **Designs are private** until she clicks **Share**, which lets Matt view or comment.
- **Claude only uses facts Katie gives it.** Open questions about the business are in [content-status.md](content-status.md). Her answers go into `brain/` so no one asks twice.
- **This repo is public.** No client names, addresses or photo location data unless Katie says they're public.
- **Some things need Matt first:** the domain, hosting, a contact form, deleting a project or page, and anything technical listed in [CLAUDE.md](../CLAUDE.md).
