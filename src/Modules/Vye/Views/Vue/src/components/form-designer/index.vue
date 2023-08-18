<template>
    <div v-if="this.designer.formConfig.gateCheckAuthorized === true" class="volcator-dialog">
        <el-dialog :style="{ 'background-color': ' rgb(0 0 0 / 0%) !important' }"  v-model="this.designer.formConfig.gateCheckAuthorized"
                   width="30%"
                   :show-close="false"
                   :close-on-click-modal="false"
                   :close-on-press-escape="false"
                   class="tw-rounded-lg-custom el-dialog-c -tw-mt-14"
                   :class="'el-overlay'">
            <div class="tw-w-full tw-max-w-md tw-px-2 sm:tw-px-0">
                <div v-if="closeVolcatorGate === true" class="tw-flex tw-justify-center tw-mb-10 tw-opacity-50 cursor-hand" @click="closeVolcatorGateHandler()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#6e6ead"  height="48px" width="48px"
                         viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                        <path class="fa-primary" fill="#ffffff"
                              d="M289.9 255.1l47.03-47.03c9.375-9.375 9.375-24.56 0-33.94s-24.56-9.375-33.94 0L256 222.1L208.1 175c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l47.03 47.03L175 303c-9.375 9.375-9.375 24.56 0 33.94c9.373 9.373 24.56 9.381 33.94 0L256 289.9l47.03 47.03c9.373 9.373 24.56 9.381 33.94 0c9.375-9.375 9.375-24.56 0-33.94L289.9 255.1z"/>
                        <path class="fa-secondary"
                              d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256C397.4 512 512 397.4 512 256S397.4 0 256 0zM336.1 303c9.375 9.375 9.375 24.56 0 33.94c-9.381 9.381-24.56 9.373-33.94 0L256 289.9l-47.03 47.03c-9.381 9.381-24.56 9.373-33.94 0c-9.375-9.375-9.375-24.56 0-33.94l47.03-47.03L175 208.1c-9.375-9.375-9.375-24.56 0-33.94s24.56-9.375 33.94 0L256 222.1l47.03-47.03c9.375-9.375 24.56-9.375 33.94 0s9.375 24.56 0 33.94l-47.03 47.03L336.1 303z"/>
                    </svg>
                </div>
                <div class="tw-flex tw-mb-6">
                    <div  class="tw-text-3xl tw-font-extrabold tw-text-transparent tw-bg-clip-text tw-bg-gradient-to-r tw-from-purple-700 tw-to-sky-600">
                        {{i18nt('application.creatorApplication')}}
                    </div>
                </div>

                <TabGroup v-model="this.selectedTab">
                    <div class="tw-p-2 tab-button">
                        <TabList class="tw-flex tw-justify-between tw-space-x-1 tw-rounded-xl p-1">
                            <Tab v-for="category in Object.keys(this.categories)"
                                 as="template"
                                 :key="category"
                                 :selected="category === this.selectedTab"
                                 @click="changeTab(category)">
                                <button
                                    :class="[
                                      'tw-w-full tw-w-32 tw-rounded-lg tw-py-2.5 tw-text-sm tw-font-medium tw-leading-5',
                                      'tw-ring-white tw-ring-opacity-60 tw-ring-offset-2 tw-ring-offset-blue-400 focus:tw-outline-none focus:tw-ring-2',
                                        category === this.selectedTab
                                        ? 'tw-bg-white tw-text-purple-700 tw-text-opacity-100 tw-shadow tw-text-purple-700 tw-text-opacity-100'
                                        : 'tw-text-white hover:tw-bg-white/[0.12] hover:tw-text-white',
                                    ]">
                                    {{ i18nt("application."+category) }}
                                </button>
                            </Tab>
                        </TabList>
                    </div>

                    <TabPanels class="mt-2">
                        <TabPanel
                            v-for="([key, posts], idx) in Object.entries(categories)"
                            :key="idx"
                            :class="['tw-rounded-xl tw-p-3 tw-ring-white '+
                                   'tw-ring-opacity-60 tw-ring-offset-2'+
                                   'tw-ring-offset-blue-400 focus:tw-outline-none'+
                                   'focus:tw-ring-2',
                                    key !== this.selectedTab ? 'tw-hidden tw-collapse': '']">
                            <ul>
                                <li
                                    v-if="key === this.selectedTab"
                                    v-for="post in posts"
                                    :key="post.id"
                                    @click="handlerApplicationName(post.title, post.id)"
                                    :class="['tw-relative tw-rounded-md tw-p-3 hover:tw-bg-gray-300 ' +
                                             'tw-text-white tw-p-3 tw-my-3  ' +
                                             'tw-shadow' +
                                             ' ',
                                             key !== this.selectedTab ? 'tw-hidden tw-collapse': '',
                                             post.active === true ? 'bg-tab-choose': 'bg-tab-choose-disabled opacity-disabled tw-pointer-events-none',
                                             createApplicationName !== post.title+'_'+post.id ? 'cursor-hand': '',
                                             ]
                                             " style="max-height: 104px">
                                    <div v-if="key === 'creatorNewApplication'" class="tw-grid tw-grid-cols-5 tw-gap-4 tw-transition hover:tw-duration-700 tw-ease-in-out">
                                        <div v-if="post.title === 'volcatorApplication'" class="tw-flex tw-self-center tw-rounded-lg tw-bg-white tw-p-2 tw-w-20 tw-h-20 tw-shadow">
                                            <img :src="post.iconLink" loading="lazy" />
                                        </div>
                                        <div v-if="post.title === 'prestahopApplication'" class="tw-flex tw-self-center tw-rounded-lg tw-bg-white tw-p-2 tw-w-20 tw-h-20 tw-shadow">
                                            <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 173 19" style="enable-background:new 0 0 173 19;" xml:space="preserve"><path d="M4.9,13.1h2.9c1.4,0,2.6-0.3,3.7-0.8c1.1-0.5,1.9-1.3,2.5-2.3c0.6-1,0.9-2.1,0.9-3.4c0-1.3-0.3-2.4-0.9-3.4
                                            c-0.6-1-1.4-1.7-2.5-2.3c-1.1-0.5-2.3-0.8-3.7-0.8H0v18.7h4.9V13.1z M4.9,4.2h2.5c0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8
                                            S9.7,8,9.3,8.4S8.2,9.1,7.4,9.1v0H4.9V4.2z"></path><path d="M31.4,9.7c0.5-0.9,0.8-1.9,0.8-3c0-1.3-0.3-2.4-0.9-3.4c-0.6-1-1.5-1.7-2.5-2.3h0c-1.1-0.5-2.3-0.8-3.8-0.8H17v18.7H22
                                            v-5.8h2.6l2.8,5.8h5.4l-3.4-7C30.2,11.3,30.9,10.6,31.4,9.7z M26.4,8.4c-0.5,0.4-1.1,0.7-1.9,0.7v0H22V4.2h2.6
                                            c0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8S26.9,8,26.4,8.4z"></path><polygon points="40,11.4 46.4,11.4 46.4,7.5 40,7.5 40,4.3 48,4.3 48,0.2 35.1,0.2 35.1,18.8 48.3,18.8 48.3,14.7 40,14.7 	"></polygon><path d="M64.6,16c0.7-0.9,1-2,1-3.1c0-1.2-0.3-2.1-0.8-2.9c-0.5-0.7-1.2-1.3-2-1.6C62,8,61,7.7,59.7,7.5C58.4,7.2,57.5,7,57,6.9
                                            c-0.6-0.2-1-0.3-1.2-0.5c-0.3-0.2-0.4-0.5-0.4-0.9c0-0.6,0.2-1,0.7-1.3c0.4-0.3,1-0.4,1.7-0.4c0.8,0,1.4,0.2,1.9,0.6
                                            c0.5,0.4,0.7,0.9,0.8,1.6h4.8c0-1.1-0.3-2.1-1-3.1c-0.6-0.9-1.5-1.6-2.7-2.1C60.4,0.3,59.1,0,57.7,0c-1.4,0-2.6,0.3-3.7,0.8
                                            c-1.1,0.5-2,1.2-2.6,2.1c-0.6,0.9-0.9,1.9-0.9,3c0,1.2,0.3,2.2,0.8,3c0.5,0.7,1.2,1.3,2,1.7c0.8,0.4,1.9,0.7,3.1,0.9
                                            c1.3,0.3,2.2,0.5,2.8,0.6c0.6,0.2,1,0.3,1.2,0.5c0.3,0.2,0.4,0.5,0.4,0.9c0,0.6-0.2,1-0.7,1.3c-0.5,0.3-1.1,0.5-1.9,0.5
                                            c-1,0-1.8-0.2-2.3-0.7h0c-0.6-0.5-0.9-1-0.9-1.8L50,12.7c0,1.2,0.3,2.3,1,3.2c0.7,1,1.6,1.7,2.9,2.3c1.2,0.6,2.6,0.8,4.1,0.8
                                            c1.4,0,2.7-0.3,3.9-0.8C63.1,17.7,64,16.9,64.6,16z"></path><polygon points="81.7,0.2 66.6,0.2 66.6,4.3 71.7,4.3 71.7,18.8 76.6,18.8 76.6,4.3 81.7,4.3 	"></polygon><path d="M86.7,0.2l-6.7,18.7h5.1l1.1-3.5h6.5l1.2,3.5h5.3L92.7,0.2H86.7z M87.6,11.4l2-6.1l2,6.1H87.6z"></path><path d="M114.4,16c0.7-0.9,1-2,1-3.1c0-1.2-0.3-2.1-0.8-2.9c-0.5-0.7-1.2-1.3-2-1.6s-1.9-0.7-3.2-0.9c-1.2-0.2-2.1-0.4-2.7-0.6
                                            c-0.6-0.2-1-0.3-1.2-0.5c-0.3-0.2-0.4-0.5-0.4-0.9c0-0.6,0.2-1,0.7-1.3c0.4-0.3,1-0.4,1.7-0.4c0.8,0,1.4,0.2,1.9,0.6
                                            c0.5,0.4,0.7,0.9,0.8,1.6h4.8c0-1.1-0.3-2.1-1-3.1c-0.6-0.9-1.5-1.6-2.7-2.1c-1.1-0.5-2.4-0.8-3.8-0.8c-1.4,0-2.6,0.3-3.7,0.8
                                            c-1.1,0.5-2,1.2-2.6,2.1c-0.6,0.9-0.9,1.9-0.9,3c0,1.2,0.3,2.2,0.8,3c0.5,0.7,1.2,1.3,2,1.7c0.8,0.4,1.9,0.7,3.1,0.9
                                            c1.3,0.3,2.2,0.5,2.8,0.6c0.6,0.2,1,0.3,1.2,0.5c0.3,0.2,0.4,0.5,0.4,0.9c0,0.6-0.2,1-0.7,1.3c-0.5,0.3-1.1,0.5-1.9,0.5
                                            c-1,0-1.8-0.2-2.3-0.7h0c-0.6-0.5-0.9-1-0.9-1.8l-4.8-0.1c0,1.2,0.3,2.3,1,3.2c0.7,1,1.6,1.7,2.9,2.3s2.6,0.8,4.1,0.8
                                            s2.7-0.3,3.9-0.8C112.8,17.7,113.7,16.9,114.4,16z"></path><polygon points="129.1,7.3 122.9,7.3 122.9,0.2 118,0.2 118,18.8 122.9,18.8 122.9,11.5 129.1,11.5 129.1,18.8 134,18.8 134,0.2
                                            129.1,0.2 	"></polygon><path d="M154.3,14.4c0.8-1.4,1.2-3.1,1.2-4.9c0-1.8-0.4-3.4-1.2-4.9c-0.8-1.4-1.9-2.6-3.3-3.4C149.5,0.4,147.9,0,146,0
                                            c-1.9,0-3.5,0.4-4.9,1.2c-1.4,0.8-2.5,2-3.3,3.4c-0.8,1.4-1.2,3.1-1.2,4.9c0,1.8,0.4,3.4,1.2,4.9c0.8,1.4,1.9,2.6,3.3,3.4
                                            c1.4,0.8,3.1,1.2,4.9,1.2c1.9,0,3.5-0.4,4.9-1.2C152.4,16.9,153.5,15.8,154.3,14.4z M149.3,13.4c-0.8,1-1.9,1.5-3.2,1.5
                                            c-1.3,0-2.4-0.5-3.2-1.5c-0.8-1-1.2-2.3-1.2-3.9s0.4-2.9,1.2-3.9c0.8-1,1.9-1.5,3.2-1.5c1.3,0,2.4,0.5,3.2,1.5
                                            c0.8,1,1.2,2.3,1.2,3.9S150.1,12.4,149.3,13.4z"></path><path d="M169.6,1c-1.1-0.5-2.3-0.8-3.7-0.8h-7.9v18.7h4.9v-5.8h2.9c1.4,0,2.6-0.3,3.7-0.8c1.1-0.5,1.9-1.3,2.5-2.3
                                            c0.6-1,0.9-2.1,0.9-3.4c0-1.3-0.3-2.4-0.9-3.4S170.7,1.5,169.6,1z M167.3,8.4c-0.5,0.4-1.1,0.7-1.9,0.7v0H163V4.2h2.5
                                            c0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8S167.8,8,167.3,8.4z"></path></svg>
                                        </div>
                                        <div v-if="key === 'creatorNewApplication'" class="tw-col-span-4">
                                            <Transition name="slide-fade">

                                                <form v-if="createApplicationName === post.title+'_'+post.id">
                                                    <span class="tw-mb-2 tw-font-bold">{{ i18nt("application.applicationName") }} </span>

                                                    <div class="tw-relative tw-mt-2">
                                                        <input type="search" id="default-search"
                                                               class="tw-block tw-w-full tw-p-3 tw-text-sm
                                                                  tw-text-gray-900 tw-border tw-border-gray-300
                                                                  tw-rounded-full tw-bg-gray-50
                                                                  tw-ring
                                                                  tw-ring-purple-200/20
                                                                  focus:tw-outline-none focus:tw-ring focus:tw-ring-purple-200/50
                                                                  dark:tw-bg-gray-700 dark:tw-border-gray-600
                                                                  dark:tw-placeholder-gray-400
                                                                  dark:tw-text-white
                                                                  dark:focus:tw-ring-blue-500
                                                                  dark:focus:tw-border-blue-500"
                                                               placeholder="Application name"
                                                               v-model="applicationName"
                                                               required>

                                                        <div class="tw-text-white tw-absolute -tw-right-3  tw-bottom-1 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-cursor-pointer"
                                                             @click="setApplicationName(post.title, post.active)">
                                                            <svg fill="#ffffff" height="38px" width="38px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-2.4 -2.4 64.80 64.80" xml:space="preserve" stroke="#ffffff" transform="matrix(-1, 0, 0, -1, 0, 0)rotate(180)" stroke-width="0.0006000000000000001"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-2.4" y="-2.4" width="64.80" height="64.80" rx="32.4" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffffff" stroke-width="0.72"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M45.563,29.174l-22-15c-0.307-0.208-0.703-0.231-1.031-0.058C22.205,14.289,22,14.629,22,15v30 c0,0.371,0.205,0.711,0.533,0.884C22.679,45.962,22.84,46,23,46c0.197,0,0.394-0.059,0.563-0.174l22-15 C45.836,30.64,46,30.331,46,30S45.836,29.36,45.563,29.174z M24,43.107V16.893L43.225,30L24,43.107z"></path> <path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30 S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"></path> </g> </g></svg>
                                                        </div>

                                                    </div>
                                                </form>

                                                <form v-else :class="[post.active === true ? 'tw-text-white' : 'tw-text-black ']">
                                                    <h2 class="tw-text-base tw-font-bold tw-leading-5 tw-break-normal">
                                                        <span class="tw-mb-2 tw-font-bold">{{ i18nt("application."+post.title) }} </span>
                                                    </h2>
                                                    <h4 class="tw-text-sm tw-font-medium tw-leading-5 tw-break-normal">
                                                        {{ i18nt("application."+post.description) }}
                                                    </h4>
                                                    <ul class="tw-mt-1 tw-flex tw-space-x-1 tw-text-xs tw-font-normal tw-leading-4">
                                                        <li>{{ post.version }}</li>
                                                    </ul>
                                                </form>
                                            </Transition>

                                        </div>
                                    </div>

                                    <div v-if="post.active === true && key  === 'creatorRecentApplication'" class="tw-grid tw-grid-cols-6 tw-cursor-pointer">
                                         <div class="tw-col-span-4 tw-flex tw-items-center"  @click="loadApplicationByName(post.applicationId, post.pageId)">
                                            <h2 class="tw-text-base tw-font-bold tw-text-white tw-leading-5 tw-break-normal ">
                                                <span class="tw-min-h-8">{{ post.applicationName }}</span>
                                            </h2>
                                        </div>
                                        <div class="tw-flex tw-col-span-2">
                                            <div v-if="askConfirmDelete !== 'askConfirmDelete_' + post.title" @click="deleteApplication(post.applicationId)" class="tw-text-white tw-font-medium tw-text-sm tw-text-center tw-w-24 tw-ml-6 tw-cursor-pointer" alt="Delete Application">
                                                <svg  viewBox="-501.76 -501.76 2027.52 2027.52" fill="#ffffff" height="38px" width="38px" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-501.76" y="-501.76" width="2027.52" height="2027.52" rx="1013.76" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.048"></g><g id="SVGRepo_iconCarrier"><path d="M32 241.6c-11.2 0-20-8.8-20-20s8.8-20 20-20l940 1.6c11.2 0 20 8.8 20 20s-8.8 20-20 20L32 241.6zM186.4 282.4c0-11.2 8.8-20 20-20s20 8.8 20 20v688.8l585.6-6.4V289.6c0-11.2 8.8-20 20-20s20 8.8 20 20v716.8l-666.4 7.2V282.4z" fill=""></path><path d="M682.4 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM367.2 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM524.8 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM655.2 213.6v-48.8c0-17.6-14.4-32-32-32H418.4c-18.4 0-32 14.4-32 32.8V208h-40v-42.4c0-40 32.8-72.8 72.8-72.8H624c40 0 72.8 32.8 72.8 72.8v48.8h-41.6z" fill=""></path></g></svg>
                                            </div>

                                            <div v-else class="tw-flex tw-justify-center tw-text-white tw-font-medium tw-text-sm tw-text-center tw-w-24 tw-cursor-pointer"  alt="Delete Application">
                                                <div class="tw-flex tw-col-span-2">
                                                    <svg @click="confirmDeleteApplication(post.applicationId, post.id)" height="38px" width="38px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="0" y="0" width="24.00" height="24.00" rx="12" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 14L9 17L18 6" stroke="#ffffff"></path> </g></svg>
                                                    <svg @click="cancelDeleteApplication()" height="38px" width="38px" viewBox="-12.8 -12.8 89.60 89.60" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#ffffff" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-12.8" y="-12.8" width="89.60" height="89.60" rx="44.8" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><line x1="8.06" y1="8.06" x2="55.41" y2="55.94"></line><line x1="55.94" y1="8.06" x2="8.59" y2="55.94"></line></g></svg>
                                                </div>
                                            </div>

                                            <div class="tw-text-white  tw-font-medium   tw-text-sm tw-px-1 tw-cursor-pointer" @click="loadApplicationByName(post.applicationId, post.pageId)" alt="Open Application">
<!--                                                <svg fill="#ffffff" height="38px" width="38px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-2.4 -2.4 64.80 64.80" xml:space="preserve" stroke="#ffffff" transform="matrix(-1, 0, 0, -1, 0, 0)rotate(180)" stroke-width="0.0006000000000000001"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-2.4" y="-2.4" width="64.80" height="64.80" rx="32.4" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffffff" stroke-width="0.72"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M45.563,29.174l-22-15c-0.307-0.208-0.703-0.231-1.031-0.058C22.205,14.289,22,14.629,22,15v30 c0,0.371,0.205,0.711,0.533,0.884C22.679,45.962,22.84,46,23,46c0.197,0,0.394-0.059,0.563-0.174l22-15 C45.836,30.64,46,30.331,46,30S45.836,29.36,45.563,29.174z M24,43.107V16.893L43.225,30L24,43.107z"></path> <path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30 S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"></path> </g> </g></svg>-->
<!--                                                <svg-icon :icon-class="'circle-play'" class-name="tw-text-l" />-->
<!--                                                <svg-icon :icon-class="'rotate-left'" class-name="tw-text-l" />-->
                                                <svg height="38px" width="38px" xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF"
                                                     viewBox="0 0 512 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->

                                                    <path class="fa-primary" fill="#FFFFFF" stroke="#ffffff"
                                                          d="M216 368c-13.69 0-24-11.2-24-24V168C192 155.3 202.2 144 216 144c4.343 0 8.677 1.176 12.51 3.516l144 88C379.6 239.9 384 247.6 384 256c0 8.359-4.352 16.12-11.48 20.48l-144 88C224.7 366.8 220.3 368 216 368z"/>
                                                    <path class="fa-secondary" fill="#6e6ead" stroke="#ffffff"
                                                          d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM372.5 276.5l-144 88C224.7 366.8 220.3 368 216 368c-13.69 0-24-11.2-24-24V168C192 155.3 202.2 144 216 144c4.344 0 8.678 1.176 12.51 3.516l144 88C379.6 239.9 384 247.6 384 256C384 264.4 379.6 272.1 372.5 276.5z"/>
                                                </svg>

                                            </div>
                                        </div>

                                        <!--                                                <div class="tw-grid tw-grid-cols-4 tw-gap-4">-->
                                        <!--                                                    <div class="tw-text-white tw-absolute -tw-right-3  tw-bottom-1 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-cursor-pointer"-->
                                        <!--                                                         @click="setApplicationName(post.title, post.active)">-->
                                        <!--                                                        <svg fill="#ffffff" height="38px" width="38px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-2.4 -2.4 64.80 64.80" xml:space="preserve" stroke="#ffffff" transform="matrix(-1, 0, 0, -1, 0, 0)rotate(180)" stroke-width="0.0006000000000000001"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-2.4" y="-2.4" width="64.80" height="64.80" rx="32.4" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffffff" stroke-width="0.72"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M45.563,29.174l-22-15c-0.307-0.208-0.703-0.231-1.031-0.058C22.205,14.289,22,14.629,22,15v30 c0,0.371,0.205,0.711,0.533,0.884C22.679,45.962,22.84,46,23,46c0.197,0,0.394-0.059,0.563-0.174l22-15 C45.836,30.64,46,30.331,46,30S45.836,29.36,45.563,29.174z M24,43.107V16.893L43.225,30L24,43.107z"></path> <path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30 S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"></path> </g> </g></svg>-->
                                        <!--                                                    </div>-->
                                        <!--                                                    <div class="tw-text-white tw-absolute tw-right-6  tw-bottom-1 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-cursor-pointer"-->
                                        <!--                                                         @click="setApplicationName(post.title, post.active)">-->
                                        <!--                                                        <svg viewBox="-225.28 -225.28 1474.56 1474.56" fill="#ffffff" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-225.28" y="-225.28" width="1474.56" height="1474.56" rx="737.28" fill="#6e6ead" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.048"></g><g id="SVGRepo_iconCarrier"><path d="M32 241.6c-11.2 0-20-8.8-20-20s8.8-20 20-20l940 1.6c11.2 0 20 8.8 20 20s-8.8 20-20 20L32 241.6zM186.4 282.4c0-11.2 8.8-20 20-20s20 8.8 20 20v688.8l585.6-6.4V289.6c0-11.2 8.8-20 20-20s20 8.8 20 20v716.8l-666.4 7.2V282.4z" fill=""></path><path d="M682.4 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM367.2 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM524.8 867.2c-11.2 0-20-8.8-20-20V372c0-11.2 8.8-20 20-20s20 8.8 20 20v475.2c0.8 11.2-8.8 20-20 20zM655.2 213.6v-48.8c0-17.6-14.4-32-32-32H418.4c-18.4 0-32 14.4-32 32.8V208h-40v-42.4c0-40 32.8-72.8 72.8-72.8H624c40 0 72.8 32.8 72.8 72.8v48.8h-41.6z" fill=""></path></g></svg>-->
                                        <!--                                                    </div>-->
                                        <!--                                                </div>-->

                                    </div>
                                    <a v-if="createApplicationName === post.title+'_'+post.id" href="#" />
                                </li>
                            </ul>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </el-dialog>
    </div>

    <div :class="['main-container full-height tw-container-fluid',
                    this.designer.formConfig.gateCheckAuthorized === true ? 'tw-blur-lg tw-pointer-events-none' : ''
                ]">
        <div class="tw-flex">
            <div class="tw-w-80">
                <widget-panel :designer="designer" />
            </div>
            <div class="center-layout-container tw-flex-auto">
                <div class="toolbar-header tw-flex-auto">
                    <toolbar-panel ref="toolbarRef" :designer="designer" @changeGateCheckAuthorizedEvent="changeGateCheckAuthorized($event)">
                        <template v-for="(idx, slotName) in $slots" #[slotName]>
                            <slot :name="slotName"></slot>
                        </template>
                    </toolbar-panel>
                </div>
                <div class="form-widget-main tw-flex-auto">
                    <el-scrollbar
                        class="container-scroll-bar"
                        :style="{ height: scrollerHeight }">
                        <v-form-widget
                            :designer="designer"
                            :form-config="designer.formConfig"></v-form-widget>
                    </el-scrollbar>
                </div>
            </div>
            <div class="tw-w-80">
                <setting-panel
                    :designer="designer"
                    :selected-widget="designer.selectedWidget"
                    :form-config="designer.formConfig"
                    @edit-event-handler="testEEH" />
            </div>
        </div>
    </div>
</template>

<script>
    import WidgetPanel from "./widget-panel/index";
    import ToolbarPanel from "./toolbar-panel/index";
    import SettingPanel from "./setting-panel/index";
    import VFormWidget from "./form-widget/index";
    import { createDesigner } from "@/components/form-designer/designer";
    import {
        addWindowResizeHandler,
        deepClone,
        getQueryParam,
        getAllContainerWidgets,
        getAllFieldWidgets,
        traverseAllWidgets
    } from "@/utils/util";
    import { MOCK_CASE_URL, VARIANT_FORM_VERSION } from "@/utils/config";
    import i18n, { changeLocale } from "@/utils/i18n";
    import axios from "axios";
    import SvgIcon from "@/components/svg-icon/index";
    import {
        checkApplicationExist,
        addPageOfApplication,
        recentApplicationsByPrefix,
        getOnePageApplication,
        assignApplicationToVyeCurrentApplication
    } from "@/components/service/service-volcator";
    import { ref } from 'vue';
    import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

    export default {
        name: "VFormDesigner",
        componentName: "VFormDesigner",
        components: {
            SvgIcon,
            WidgetPanel,
            ToolbarPanel,
            SettingPanel,
            VFormWidget
        },
        mixins: [i18n],
        emits: ["changeGateCheckAuthorizedEvent"],
        provide() {
            return {
                serverFieldList: this.fieldList,
                getDesignerConfig: () => this.designerConfig,
                getBannedWidgets: () => this.bannedWidgets
            };
        },
        props: {
            /* 后端字段列表API */
            fieldListApi: {
                type: Object,
                default: null
            },

            /* 禁止显示的组件名称数组 */
            bannedWidgets: {
                type: Array,
                default: () => []
            },
            application: '',
            isApplicationExist: '',
            designerConfig: {
                type: Object,
                default: () => {
                    return {
                        languageMenu: true, //是否显示语言切换菜单
                        externalLink: true, //是否显示GitHub、文档等外部链接
                        formTemplates: true, //是否显示表单模板
                        eventCollapse: true, //是否显示组件事件属性折叠面板
                        widgetNameReadonly: false, //禁止修改组件名称

                        clearDesignerButton: true, //是否显示清空设计器按钮
                        previewFormButton: true, //是否显示预览表单按钮
                        importJsonButton: true, //是否显示导入JSON按钮
                        exportJsonButton: true, //是否显示导出JSON器按钮
                        exportCodeButton: true, //是否显示导出代码按钮
                        generateSFCButton: true, //是否显示生成SFC按钮

                        toolbarMaxWidth: 420, //设计器工具按钮栏最大宽度（单位像素）
                        toolbarMinWidth: 300, //设计器工具按钮栏最小宽度（单位像素）

                        presetCssCode: "", //设计器预设CSS样式代码

                        resetFormJson: false //是否在设计器初始化时将表单内容重置为空
                    };
                }
            }
        },
        computed: {
            // selectedTab() {
            //     return ref(0);
            // },

        },
        data() {
            return {
                vFormVersion: VARIANT_FORM_VERSION,
                curLangName: "",
                curLocale: "",

                createApplicationName: '',
                applicationName: 'Main application',
                askConfirmDelete: '',
                closeVolcatorGate: false,

                vsCodeFlag: false,
                caseName: "",

                docUrl: "https://www.vform666.com/document3.html",
                gitUrl: "https://github.com/vform666/variant-form3-vite",
                chatUrl: "https://www.vform666.com/pages/chat-group/",
                subScribeUrl: "https://www.vform666.com/pages/pro/",

                scrollerHeight: 0,

                designer: createDesigner(this),

                fieldList: [],
                selectedTab: "creatorNewApplication",
                categories: {
                    creatorNewApplication: [
                        {
                            id: 1,
                            title: 'volcatorApplication',
                            description: 'volcatorApplicationDescription',
                            iconLink: 'https://volcator.com/_nuxt/volcator-logo.4c665c65.png',
                            active: true,
                            version: 'v 1.13',
                        },
                        {
                            id: 2,
                            title: 'prestahopApplication',
                            description: 'prestahopApplicationDescription',
                            iconLink: '<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 173 19" style="enable-background:new 0 0 173 19;" xml:space="preserve"><path d="M4.9,13.1h2.9c1.4,0,2.6-0.3,3.7-0.8c1.1-0.5,1.9-1.3,2.5-2.3c0.6-1,0.9-2.1,0.9-3.4c0-1.3-0.3-2.4-0.9-3.4\n' +
                                '\t\t\tc-0.6-1-1.4-1.7-2.5-2.3c-1.1-0.5-2.3-0.8-3.7-0.8H0v18.7h4.9V13.1z M4.9,4.2h2.5c0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8\n' +
                                '\t\t\tS9.7,8,9.3,8.4S8.2,9.1,7.4,9.1v0H4.9V4.2z"></path><path d="M31.4,9.7c0.5-0.9,0.8-1.9,0.8-3c0-1.3-0.3-2.4-0.9-3.4c-0.6-1-1.5-1.7-2.5-2.3h0c-1.1-0.5-2.3-0.8-3.8-0.8H17v18.7H22\n' +
                                '\t\t\tv-5.8h2.6l2.8,5.8h5.4l-3.4-7C30.2,11.3,30.9,10.6,31.4,9.7z M26.4,8.4c-0.5,0.4-1.1,0.7-1.9,0.7v0H22V4.2h2.6\n' +
                                '\t\t\tc0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8S26.9,8,26.4,8.4z"></path><polygon points="40,11.4 46.4,11.4 46.4,7.5 40,7.5 40,4.3 48,4.3 48,0.2 35.1,0.2 35.1,18.8 48.3,18.8 48.3,14.7 40,14.7 \t"></polygon><path d="M64.6,16c0.7-0.9,1-2,1-3.1c0-1.2-0.3-2.1-0.8-2.9c-0.5-0.7-1.2-1.3-2-1.6C62,8,61,7.7,59.7,7.5C58.4,7.2,57.5,7,57,6.9\n' +
                                '\t\t\tc-0.6-0.2-1-0.3-1.2-0.5c-0.3-0.2-0.4-0.5-0.4-0.9c0-0.6,0.2-1,0.7-1.3c0.4-0.3,1-0.4,1.7-0.4c0.8,0,1.4,0.2,1.9,0.6\n' +
                                '\t\t\tc0.5,0.4,0.7,0.9,0.8,1.6h4.8c0-1.1-0.3-2.1-1-3.1c-0.6-0.9-1.5-1.6-2.7-2.1C60.4,0.3,59.1,0,57.7,0c-1.4,0-2.6,0.3-3.7,0.8\n' +
                                '\t\t\tc-1.1,0.5-2,1.2-2.6,2.1c-0.6,0.9-0.9,1.9-0.9,3c0,1.2,0.3,2.2,0.8,3c0.5,0.7,1.2,1.3,2,1.7c0.8,0.4,1.9,0.7,3.1,0.9\n' +
                                '\t\t\tc1.3,0.3,2.2,0.5,2.8,0.6c0.6,0.2,1,0.3,1.2,0.5c0.3,0.2,0.4,0.5,0.4,0.9c0,0.6-0.2,1-0.7,1.3c-0.5,0.3-1.1,0.5-1.9,0.5\n' +
                                '\t\t\tc-1,0-1.8-0.2-2.3-0.7h0c-0.6-0.5-0.9-1-0.9-1.8L50,12.7c0,1.2,0.3,2.3,1,3.2c0.7,1,1.6,1.7,2.9,2.3c1.2,0.6,2.6,0.8,4.1,0.8\n' +
                                '\t\t\tc1.4,0,2.7-0.3,3.9-0.8C63.1,17.7,64,16.9,64.6,16z"></path><polygon points="81.7,0.2 66.6,0.2 66.6,4.3 71.7,4.3 71.7,18.8 76.6,18.8 76.6,4.3 81.7,4.3 \t"></polygon><path d="M86.7,0.2l-6.7,18.7h5.1l1.1-3.5h6.5l1.2,3.5h5.3L92.7,0.2H86.7z M87.6,11.4l2-6.1l2,6.1H87.6z"></path><path d="M114.4,16c0.7-0.9,1-2,1-3.1c0-1.2-0.3-2.1-0.8-2.9c-0.5-0.7-1.2-1.3-2-1.6s-1.9-0.7-3.2-0.9c-1.2-0.2-2.1-0.4-2.7-0.6\n' +
                                '\t\t\tc-0.6-0.2-1-0.3-1.2-0.5c-0.3-0.2-0.4-0.5-0.4-0.9c0-0.6,0.2-1,0.7-1.3c0.4-0.3,1-0.4,1.7-0.4c0.8,0,1.4,0.2,1.9,0.6\n' +
                                '\t\t\tc0.5,0.4,0.7,0.9,0.8,1.6h4.8c0-1.1-0.3-2.1-1-3.1c-0.6-0.9-1.5-1.6-2.7-2.1c-1.1-0.5-2.4-0.8-3.8-0.8c-1.4,0-2.6,0.3-3.7,0.8\n' +
                                '\t\t\tc-1.1,0.5-2,1.2-2.6,2.1c-0.6,0.9-0.9,1.9-0.9,3c0,1.2,0.3,2.2,0.8,3c0.5,0.7,1.2,1.3,2,1.7c0.8,0.4,1.9,0.7,3.1,0.9\n' +
                                '\t\t\tc1.3,0.3,2.2,0.5,2.8,0.6c0.6,0.2,1,0.3,1.2,0.5c0.3,0.2,0.4,0.5,0.4,0.9c0,0.6-0.2,1-0.7,1.3c-0.5,0.3-1.1,0.5-1.9,0.5\n' +
                                '\t\t\tc-1,0-1.8-0.2-2.3-0.7h0c-0.6-0.5-0.9-1-0.9-1.8l-4.8-0.1c0,1.2,0.3,2.3,1,3.2c0.7,1,1.6,1.7,2.9,2.3s2.6,0.8,4.1,0.8\n' +
                                '\t\t\ts2.7-0.3,3.9-0.8C112.8,17.7,113.7,16.9,114.4,16z"></path><polygon points="129.1,7.3 122.9,7.3 122.9,0.2 118,0.2 118,18.8 122.9,18.8 122.9,11.5 129.1,11.5 129.1,18.8 134,18.8 134,0.2 \n' +
                                '\t\t\t129.1,0.2 \t"></polygon><path d="M154.3,14.4c0.8-1.4,1.2-3.1,1.2-4.9c0-1.8-0.4-3.4-1.2-4.9c-0.8-1.4-1.9-2.6-3.3-3.4C149.5,0.4,147.9,0,146,0\n' +
                                '\t\t\tc-1.9,0-3.5,0.4-4.9,1.2c-1.4,0.8-2.5,2-3.3,3.4c-0.8,1.4-1.2,3.1-1.2,4.9c0,1.8,0.4,3.4,1.2,4.9c0.8,1.4,1.9,2.6,3.3,3.4\n' +
                                '\t\t\tc1.4,0.8,3.1,1.2,4.9,1.2c1.9,0,3.5-0.4,4.9-1.2C152.4,16.9,153.5,15.8,154.3,14.4z M149.3,13.4c-0.8,1-1.9,1.5-3.2,1.5\n' +
                                '\t\t\tc-1.3,0-2.4-0.5-3.2-1.5c-0.8-1-1.2-2.3-1.2-3.9s0.4-2.9,1.2-3.9c0.8-1,1.9-1.5,3.2-1.5c1.3,0,2.4,0.5,3.2,1.5\n' +
                                '\t\t\tc0.8,1,1.2,2.3,1.2,3.9S150.1,12.4,149.3,13.4z"></path><path d="M169.6,1c-1.1-0.5-2.3-0.8-3.7-0.8h-7.9v18.7h4.9v-5.8h2.9c1.4,0,2.6-0.3,3.7-0.8c1.1-0.5,1.9-1.3,2.5-2.3\n' +
                                '\t\t\tc0.6-1,0.9-2.1,0.9-3.4c0-1.3-0.3-2.4-0.9-3.4S170.7,1.5,169.6,1z M167.3,8.4c-0.5,0.4-1.1,0.7-1.9,0.7v0H163V4.2h2.5\n' +
                                '\t\t\tc0.8,0,1.4,0.2,1.9,0.7c0.5,0.4,0.7,1,0.7,1.8S167.8,8,167.3,8.4z"></path></svg>',
                            active: false,
                            version: 'v 8.0.4',
                        },
                    ],
                    creatorRecentApplication: [],
                    creatorPublishedApplication: [
                        {
                            id: 1,
                            title: 'volcatorApplication',
                            description: 'volcatorApplicationDescription',
                            active: false,
                            version: 'v 1.13',
                        },
                        {
                            id: 2,
                            title: 'volcatorApplication',
                            description: 'volcatorApplicationDescription',
                            active: false,
                            version: 'v 1.13',
                        },
                    ],
                },
            };
        },
        created() {
            this.volcatorApplication = window.localStorage.getItem("volcator_application");
            this.vsCodeFlag = getQueryParam("vscode") == 1;
            this.caseName = getQueryParam("case");
        },
        mounted() {
            this.recentApplicationsByPrefix();
            this.initLocale();

            this.scrollerHeight = window.innerHeight - 56 - 36 + "px";
            addWindowResizeHandler(() => {
                this.$nextTick(() => {
                    this.scrollerHeight = window.innerHeight - 56 - 36 + "px";
                });
            });

            this.loadCase();
            this.loadFieldListFromServer();
            this.designer.setPreviewOrRender(false);

        },
        onBeforeMount() {
            //
        },
        methods: {
            changeGateCheckAuthorized () {
                this.recentApplicationsByPrefix();
                this.closeVolcatorGate = true;
            },
            closeVolcatorGateHandler() {
                this.designer.formConfig.gateCheckAuthorized = false;
            },
            isDialogVisible(status) {
                this.designer.formConfig.gateCheckAuthorized = status
            },
            applicationCheckOrCreateByType(application, status, name) {
                if (status !== true) {
                    return;
                }
                if (application === 'volcatorApplication') {
                    checkApplicationExist(this.volcatorApplication)
                        .then(response => {
                            let isApplicationExist = response.data.exists;
                            let masterApplicationName = this.volcatorApplication;
                            if (isApplicationExist === true) {
                                masterApplicationName = this.volcatorApplication+'_'+Date.now();
                            }
                            this.designer.clearDesigner();

                            this.designer.formConfig.applicationName = name;
                            this.designer.formConfig.initSpaceApplicationId = this.volcatorApplication;
                            this.designer.formConfig.applicationId = masterApplicationName;
                            const applicationRequestCommand = {
                                page: this.getFormJson(),
                                application: masterApplicationName,
                                id: null
                            };
                            addPageOfApplication(applicationRequestCommand, masterApplicationName).then(response => {
                                this.designer.formConfig.pageId = response.data.value;
                                assignApplicationToVyeCurrentApplication(this.designer.formConfig.pageId).then(response => {
                                    // console.log(response.data.status)
                                });
                                this.isDialogVisible(false);
                            });

                        }).catch(error => {
                            console.error(error);
                        });
                }
            },
            recentApplicationsByPrefix() {
                recentApplicationsByPrefix(this.volcatorApplication)
                    .then(response => {
                        this.categories.creatorRecentApplication = response.data.applications;
                    }).catch(error => {
                    console.error(error);
                    });
            },
            loadApplicationByName(applicationName, applicationId) {
                getOnePageApplication(applicationName, applicationId).then(response => {
                    this.designer.widgetList = response[0].widgetList;
                    this.designer.formConfig = response[0].formConfig;
                    this.isDialogVisible(false);
                }).catch(error => {
                    console.error(error);
                });
            },
            deleteApplication(applicationId) {
                this.askConfirmDelete = 'askConfirmDelete_' + applicationId;
            },
            confirmDeleteApplication(application, id) {
                const index = this.categories.creatorRecentApplication.findIndex(item => item.applicationId === application);
                if (index !== -1) {
                    this.categories.creatorRecentApplication.splice(index, 1);
                }
                this.designer.deleteApplicationAndClearDesigner(application);
                this.askConfirmDelete = false;
            },
            cancelDeleteApplication() {
                this.askConfirmDelete = false;
            },
            changeTab(tab) {
                this.selectedTab = tab
            },
            handlerApplicationName(title, id) {
                this.createApplicationName = title+'_'+id;
            },
            setApplicationName(title, status) {
                if (this.applicationName === '') {
                    this.applicationName =  'Volcator Application'
                }
                this.applicationCheckOrCreateByType(title, status, this.applicationName);
            },
            testEEH(eventName, eventParams) {
                console.log("test", eventName);
                console.log("test222222", eventParams);
            },

            showLink(configName) {
                if (this.designerConfig[configName] === undefined) {
                    return true;
                }

                return !!this.designerConfig[configName];
            },

            openHome() {
                if (this.vsCodeFlag) {
                    const msgObj = {
                        cmd: "openUrl",
                        data: {
                            url: "https://www.vform666.com/"
                        }
                    };
                    window.parent.postMessage(msgObj, "*");
                }
            },

            openUrl(event, url) {
                if (this.vsCodeFlag) {
                    const msgObj = {
                        cmd: "openUrl",
                        data: {
                            url
                        }
                    };
                    window.parent.postMessage(msgObj, "*");
                } else {
                    let aDom = event.currentTarget;
                    aDom.href = url;
                    //window.open(url, '_blank') //直接打开新窗口，会被浏览器拦截
                }
            },

            loadCase() {
                if (!this.caseName) {
                    return;
                }

                axios
                    .get(MOCK_CASE_URL + this.caseName + ".txt")
                    .then((res) => {
                        if (res.data.code) {
                            this.$message.error(this.i18nt("designer.hint.sampleLoadedFail"));
                            return;
                        }

                        this.setFormJson(res.data);
                        this.$message.success(
                            this.i18nt("designer.hint.sampleLoadedSuccess")
                        );
                    })
                    .catch((error) => {
                        this.$message.error(
                            this.i18nt("designer.hint.sampleLoadedFail") + ":" + error
                        );
                    });
            },

            initLocale() {
                this.curLocale = localStorage.getItem("v_form_locale");
                switch (this.curLocale) {
                    case "en":
                        this.curLocale = "en-US";
                        break;
                    case "zh":
                        this.curLocale = "zh-CN";
                        break;
                    case "fr":
                        this.curLocale = "fr-FR";
                        break;
                    case 3:
                        day = "Wednesday";
                        break;
                    case 4:
                        day = "Thursday";
                        break;
                    case 5:
                        day = "Friday";
                        break;
                    default:
                        this.curLocale = "en-US";
                }
                this.curLangName = this.i18nt("application." + this.curLocale);
                this.changeLanguage(this.curLocale);
            },

            loadFieldListFromServer() {
                if (!this.fieldListApi) {
                    return;
                }

                let headers = this.fieldListApi.headers || {};
                axios
                    .get(this.fieldListApi.URL, { headers: headers })
                    .then((res) => {
                        let labelKey = this.fieldListApi.labelKey || "label";
                        let nameKey = this.fieldListApi.nameKey || "name";

                        this.fieldList.splice(0, this.fieldList.length); //清空已有
                        res.data.forEach((fieldItem) => {
                            this.fieldList.push({
                                label: fieldItem[labelKey],
                                name: fieldItem[nameKey]
                            });
                        });
                    })
                    .catch((error) => {
                        this.$message.error(error);
                    });
            },

            // handleLanguageChanged(command) {
            //   this.changeLanguage(command)
            //   this.curLangName = this.i18nt('application.' + command)
            // },

            changeLanguage(langName) {
                changeLocale(langName);
            },

            setFormJson(formJson) {
                let modifiedFlag = false;
                if (formJson) {
                    if (typeof formJson === "string") {
                        modifiedFlag = this.designer.loadFormJson(JSON.parse(formJson));
                    } else if (formJson.constructor === Object) {
                        modifiedFlag = this.designer.loadFormJson(formJson);
                    }

                    if (modifiedFlag) {
                        this.designer.emitHistoryChange();
                    }
                }
            },

            getFormJson() {
                return {
                    widgetList: deepClone(this.designer.widgetList),
                    formConfig: deepClone(this.designer.formConfig)
                };
            },

            clearDesigner() {
                this.$refs.toolbarRef.clearFormWidget();
            },

            /**
             * 刷新表单设计器
             */
            refreshDesigner() {
                //this.designer.loadFormJson( this.getFormJson() )  //只有第一次调用生效？？

                let fJson = this.getFormJson();
                this.designer.clearDesigner(true); //不触发历史记录变更
                this.designer.loadFormJson(fJson);
            },

            /**
             * 预览表单
             */
            previewForm() {
                this.$refs.toolbarRef.previewForm();
            },

            /**
             * 导入表单JSON
             */
            importJson() {
                this.$refs.toolbarRef.importJson();
            },

            /**
             * 导出表单JSON
             */
            exportJson() {
                this.$refs.toolbarRef.exportJson();
            },

            /**
             * 导出Vue/HTML代码
             */
            exportCode() {
                this.$refs.toolbarRef.exportCode();
            },

            /**
             * 生成SFC代码
             */
            generateSFC() {
                this.$refs.toolbarRef.generateSFC();
            },

            /**
             * 获取所有字段组件
             * @returns {*[]}
             */
            getFieldWidgets(widgetList = null) {
                return widgetList
                    ? getAllFieldWidgets(widgetList)
                    : getAllFieldWidgets(this.designer.widgetList);
            },

            /**
             * 获取所有容器组件
             * @returns {*[]}
             */
            getContainerWidgets(widgetList = null) {
                return widgetList
                    ? getAllContainerWidgets(widgetList)
                    : getAllContainerWidgets(this.designer.widgetList);
            },

            /**
             * 升级表单json，以补充最新的组件属性
             * @param formJson
             */
            upgradeFormJson(formJson) {
                if (!formJson.widgetList || !formJson.formConfig) {
                    this.$message.error("Invalid form json!");
                    return;
                }

                traverseAllWidgets(formJson.widgetList, (w) => {
                    this.designer.upgradeWidgetConfig(w);
                });
                this.designer.upgradeFormConfig(formJson.formConfig);

                return formJson;
            },

            getWidgetRef(widgetName, showError = false) {
                return this.$refs["formRef"].getWidgetRef(widgetName, showError);
            },

            getSelectedWidgetRef() {
                return this.$refs["formRef"].getSelectedWidgetRef();
            }

            //TODO: 增加更多方法！！
        }
    };
</script>

<style lang="scss" scoped>
    .main-container {
        padding: 0;
        background: #f1f2f3;

        :deep(aside) {
            /* 防止aside样式被外部样式覆盖！！ */
            margin: 0;
            padding: 0;
            background: inherit;
        }
    }

    .el-container.full-height {
        height: 100%;
        overflow-y: hidden;
    }

    .center-layout-container {
        min-width: 680px;
        max-width: 1280px;
        /*border-left: 2px dotted #EBEEF5;*/
        /*border-right: 2px dotted #EBEEF5;*/
    }

    .el-header.main-header {
        /*border-bottom: 2px dotted #EBEEF5;*/
        height: 48px !important;
        line-height: 48px !important;
        min-width: 800px;
    }

    div.main-title {
        font-size: 18px;
        color: #242424;
        display: flex;
        align-items: center;
        justify-items: center;

        img {
            cursor: pointer;
            width: 36px;
            height: 36px;
        }

        span.bold {
            font-size: 20px;
            font-weight: bold;
            margin: 0 6px 0 6px;
        }

        span.version-span {
            font-size: 14px;
            color: #101f1c;
            margin-left: 6px;
        }
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .el-dropdown-link {
        margin-right: 12px;
        cursor: pointer;
    }

    div.external-link {
        display: flex;
        align-items: center;

        a {
            font-size: 13px;
            text-decoration: none;
            margin-right: 10px;
            color: #606266;
        }
    }

    .toolbar-header {
        min-height: 38px !important;
        padding: 0 10px;
    }

    .side-panel {
        overflow-y: hidden;
    }

    .el-main.form-widget-main {
        padding: 0;

        position: relative;
        overflow-x: hidden;
    }

    .container-scroll-bar {
        :deep(.el-scrollbar__wrap),
        :deep(.el-scrollbar__view) {
            overflow-x: hidden;
        }
    }

    .tab-button {
        border-radius: 15px;
        background: rgb(62, 155, 209);
        background: linear-gradient(90deg, rgba(62, 155, 209, 0.6) 0%, rgba(110, 79, 183, 0.6) 100%);
    }

    .bg-tab-choose {
        background-color: rgba(110, 110, 173, 0.9);
        overflow: hidden;
    }

    .bg-tab-choose:hover {
        background-color: rgba(110, 110, 173, 1);
    }
    .bg-tab-choose-disabled {
        /*background-color: rgba(56, 189, 248, 0.7);*/
        /*background-color: rgba(139, 92, 246, 0.7);*/
        background-color: rgba(156, 156, 156, 0.6);
    }
    .opacity-disabled {
        opacity: 0.3;
    }
    .slide-fade-enter-active {
        /*transition: all 0.1s ease-out;*/
    }

    .slide-fade-leave-active {
        /*transition: all 0.1s ease-out;*/
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        /*transform: translateY(20px);*/
        opacity: 0;
    }
    .cursor-hand {
        cursor: grab;
    }
</style>
