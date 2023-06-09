class Mailbox {
    get options() {
        return {};
    }
    constructor(e = {}) {
        (this.settings = Object.assign(this.options, e)),
            (this.emailListContainer = document.getElementById("emailListContainer")),
            (this.emailCorrespondenceContainer = document.getElementById("emailCorrespondenceContainer")),
            (this.emailListTemplate = document.getElementById("emailListTemplate")),
            (this.emailListBadgeTemplate = document.getElementById("emailListBadgeTemplate")),
            (this.checkAllButton = document.getElementById("checkAllButton")),
            (this.backButton = document.getElementById("backButton")),
            (this.replyButton = document.getElementById("replyButton")),
            (this.forwardButton = document.getElementById("forwardButton")),
            (this.detailBottomButtons = document.getElementById("detailBottomButtons")),
            (this.replyEmailForm = document.getElementById("replyEmailForm")),
            (this.replyDeleteButton = document.getElementById("replyDeleteButton")),
            (this.emailSearch = document.getElementById("emailSearch")),
            (this.emailMenuButton = document.getElementById("emailMenuButton")),
            (this.emailMenuModal = new bootstrap.Modal(document.getElementById("emailMenuModal"))),
            (this.newEmailButton = document.getElementById("newEmailButton")),
            (this.newEmailModal = new bootstrap.Modal(document.getElementById("newEmailModal"))),
            (this.currentShowSettings = { folder: "inbox", starred: "All", important: "All", tags: "All" }),
            (this.activeMenuId = 1),
            (this.currentScreen = null),
            (this.fuseOptions = { includeScore: !0, keys: ["title", "from", "detail"], threshold: 0.4 }),
            // http://127.0.0.1:8000/acron/json/mailbox.json

            Helpers.FetchJSON(document.getElementById('url').value, (e) => {
                (this.emailData = e), this._init();
            }),
            "undefined" != typeof baguetteBox && this._initLightbox();
    }
    _init() {
        this._showListScreen(), this._renderItems(), this._initMoveContent(), this._addListeners(), this._initEmailAddress(), this._initEmailEditor(), this._initCheckAll();
    }
    _renderItems(e) {
        this.emailListContainer.innerHTML = "";
        const t = this.currentShowSettings;
        (e || this.emailData)[t.folder].map((e) => {
            const i = this._getTagStringByEmail(e);
            (t.starred !== e.starred && !t.starred.toString().includes("All")) || (t.important !== e.important && !t.important.toString().includes("All")) || (!i.includes(t.tags) && !t.tags.includes("All")) || this._renderListItem(e);
        }),
            this._initClamp();
    }
    _renderListItem(e) {
        var t = this.emailListTemplate.content.cloneNode(!0).querySelector("div");
        t.setAttribute("data-id", e.id),
            e.emails.length > 1 ? (t.querySelector(".from").innerHTML = e.from + " (" + e.emails.length + ")") : (t.querySelector(".from").innerHTML = e.from),
            (t.querySelector(".title").innerHTML = e.title),
            (t.querySelector(".detail").innerHTML = e.detail),
            (t.querySelector(".dateTime").innerHTML = e.dateTime),
            e.unread
                ? (t.querySelector(".from").classList.add("text-body"), t.querySelector(".title").classList.add("text-body"), t.querySelector(".from").classList.add("fw-bold"), t.querySelector(".title").classList.add("fw-bold"))
                : (t.querySelector(".from").classList.add("text-alternate"), t.querySelector(".title").classList.add("text-alternate")),
            e.starred && t.querySelector(".star") && t.querySelector(".star").classList.remove("invisible"),
            e.important && t.querySelector(".bell") && t.querySelector(".bell").classList.remove("invisible"),
            e.tags.map((e) => {
                var i = this.emailListBadgeTemplate.content.cloneNode(!0).querySelector("span");
                (i.innerHTML = e.title), t.querySelector(".badges").append(i);
            }),
            this.emailListContainer.append(t),
            new AcornIcons().replace();
    }
    _initClamp() {
        document.querySelectorAll(".clamp-line").forEach((e) => {
            const t = e.getAttribute("data-line");
            t && $clamp(e, { clamp: parseInt(t) });
        });
    }
    _addListeners() {
        this.emailListContainer && this.emailListContainer.addEventListener("click", this._onEmailClick.bind(this)),
            this.emailMenuButton && this.emailMenuButton.addEventListener("click", this._showEmailMenuModal.bind(this)),
            this.newEmailButton && this.newEmailButton.addEventListener("click", this._showNewEmailModal.bind(this)),
            this.backButton && this.backButton.addEventListener("click", this._backButtonClick.bind(this)),
            this.replyButton && this.replyButton.addEventListener("click", this._replyButtonClick.bind(this)),
            this.forwardButton && this.forwardButton.addEventListener("click", this._forwardButtonClick.bind(this)),
            this.replyDeleteButton && this.replyDeleteButton.addEventListener("click", this._replyDeleteButtonClick.bind(this)),
            this.emailSearch && this.emailSearch.addEventListener("keydown", Helpers.Debounce(this._onSearchKeyDown.bind(this), 500).bind(this));
    }
    _getTagStringByEmail(e) {
        var t = "";
        return (
            e.tags.map((e) => {
                t += e.title;
            }),
            t
        );
    }
    _addMenuListeners() {
        document.querySelector(".menu-items") && document.querySelector(".menu-items").addEventListener("click", this._onMenuClick.bind(this));
    }
    _initEmailAddress() {
        "undefined" != typeof Tagify &&
            (null !== document.querySelector("#replyEmailAddress") && new Tagify(document.querySelector("#replyEmailAddress")),
                null !== document.querySelector("#composeEmailAddress") && new Tagify(document.querySelector("#composeEmailAddress")));
    }
    _initEmailEditor() {
        if ("undefined" != typeof Quill) {
            Quill.register("modules/active", Active);
            const e = {
                toolbar: [["bold", "italic", "underline", "strike"], [{ header: [1, 2, 3, 4, 5, 6, !1] }], [{ list: "ordered" }, { list: "bullet" }], [{ size: ["small", !1, "large", "huge"] }], [{ color: [] }], [{ align: [] }]],
                active: {},
            };
            document.getElementById("quillEditorFilledEmail") && new Quill("#quillEditorFilledEmail", { modules: e, theme: "bubble", placeholder: "Answer" }),
                document.getElementById("quillEditorFilledEmailNew") && new Quill("#quillEditorFilledEmailNew", { modules: e, theme: "bubble", placeholder: "Message" });
        }
    }
    _initCheckAll() {
        new Checkall(document.querySelector(".check-all-container-checkbox-click .btn-custom-control"), { clickSelector: ".form-check" });
    }
    _onMenuClick(e) {
        e.target;
        const t = e.target.closest(".mailbox-menu-item");
        if (!t) return;
        e.preventDefault();
        const i = JSON.parse(t.getAttribute("data-show"));
        (this.currentShowSettings = i), this._renderItems(), this._setActiveMenuItem(t), this._hideEmailMenuModal(), this._showListScreen();
    }
    _setActiveMenuItem(e) {
        document.querySelectorAll(".mailbox-menu-item").forEach((e) => {
            e.classList.remove("active");
        }),
            e.classList.add("active"),
            (this.activeMenuId = parseInt(e.getAttribute("data-menuid")));
    }
    _setActiveMenuItemAfterMove() {
        document.querySelectorAll(".mailbox-menu-item").forEach((e) => {
            e.classList.remove("active"), parseInt(e.getAttribute("data-menuid")) === this.activeMenuId && e.classList.add("active");
        });
    }
    _initMoveContent() {
        if (document.querySelector("#emailMoveContent") && "undefined" != typeof MoveContent) {
            const e = document.querySelector("#emailMoveContent"),
                t = e.getAttribute("data-move-target"),
                i = e.getAttribute("data-move-breakpoint");
            new MoveContent(e, {
                targetSelector: t,
                moveBreakpoint: i,
                afterMove: (e) => {
                    this._hideEmailMenuModal(), this._addMenuListeners(), this._setActiveMenuItemAfterMove();
                },
            });
        }
    }
    _onSearchKeyDown(e) {
        const t = emailSearch.value;
        if ("" !== t) {
            this.fuse = new Fuse(this.emailData[this.currentShowSettings.folder], this.fuseOptions);
            var i = this.fuse.search(t);
            i = i.map((e) => e.item);
            var n = {};
            (n[this.currentShowSettings.folder] = i), this._renderItems(n);
        } else this._renderItems();
    }
    _hideEmailMenuModal() {
        this.emailMenuModal.hide();
    }
    _showEmailMenuModal() {
        this.emailMenuModal.show();
    }
    _showNewEmailModal() {
        this.newEmailModal.show();
    }
    _onEmailClick(e) {
        const t = e.target.closest(".email-list-item"),
            i = e.target.closest(".form-check");
        t && !i && this._showDetailScreen();
    }
    _showDetailScreen() {
        "detail" !== this.currentScreen &&
            (this.emailCorrespondenceContainer.classList.remove("d-none"),
                this.emailListContainer.classList.add("d-none"),
                this.checkAllButton.classList.add("d-none"),
                this.backButton.classList.remove("d-none"),
                this.detailBottomButtons.classList.remove("d-none"),
                this.replyEmailForm.classList.add("d-none"),
                (this.currentScreen = "detail"));
    }
    _showListScreen() {
        "list" !== this.currentScreen &&
            (this.emailCorrespondenceContainer.classList.add("d-none"),
                this.emailListContainer.classList.remove("d-none"),
                this.checkAllButton.classList.remove("d-none"),
                this.backButton.classList.add("d-none"),
                (this.currentScreen = "list"));
    }
    _backButtonClick(e) {
        this._showListScreen();
    }
    _replyButtonClick(e) {
        this.detailBottomButtons.classList.add("d-none"), this.replyEmailForm.classList.remove("d-none"), window.scrollTo(0, document.body.scrollHeight);
    }
    _forwardButtonClick(e) {
        this.detailBottomButtons.classList.add("d-none"), this.replyEmailForm.classList.remove("d-none"), window.scrollTo(0, document.body.scrollHeight);
    }
    _replyDeleteButtonClick(e) {
        this.replyEmailForm.classList.add("d-none"), this.detailBottomButtons.classList.remove("d-none");
    }
    _initLightbox() {
        baguetteBox.run(".lightbox");
    }
}
