<div class="flex flex-col items-center w-full min-h-screen">
  <div class="flex w-full flex-col items-center justify-center m-10">
  <div class="w-full md:w-4/5">
    <div class="relative right-0 w-full">
      <ul wire:ignore
        class="relative flex list-none flex-wrap rounded-xl bg-slate-400 p-1"
        data-tabs="tabs"
        role="list"
      >
        <li class="z-30 flex-auto text-center">
          <a
            class="text-slate-700 z-30 mb-0 flex w-full cursor-pointer items-center justify-center rounded-lg border-0 bg-inherit px-0 py-1 transition-all ease-in-out"
            data-tab-target=""
            active=""
            role="tab"
            aria-selected="true"
            aria-controls="addTeam"
          >
            <span class="ml-1 text-white">Teams</span>
          </a>
        </li>
        <li class="z-30 flex-auto text-center">
          <a
            class="text-slate-700 z-30 mb-0 flex w-full cursor-pointer items-center justify-center rounded-lg border-0 bg-inherit px-0 py-1 transition-all ease-in-out"
            data-tab-target=""
            role="tab"
            aria-selected="false"
            aria-controls="addCandidates"
          >
            <span class="ml-1 text-white">Candidates</span>
          </a>
        </li>
      </ul>
      <div data-tab-content="" class="p-5">

        <!-- Add Team -->
        <div class="block opacity-100" wire:ignore.self id="addTeam" role="tabpanel">
            <div class="flex flex-col w-full items-center justify-center">
              <div class="shadow-md border bg-white w-full md:w-full rounded-lg">
                  <form>
                  <div class="flex flex-col gap-10 justify-center items-center m-5">
                    <div class="relative h-11 w-full min-w-[200px]">
                      <input type="text" wire:model="team_name"
                        placeholder="Team Name"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-blue-700 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                      />
                      <label class="after:content[' '] pointer-events-none absolute left-0 -top-2.5 flex h-full w-full select-none text-sm font-normal leading-tight text-blue-gray-700 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-blue-700 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-700 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:after:scale-x-100 peer-focus:after:border-blue-700 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
                        Team Name
                      </label>
                      @error('team_name') <span class="text-red-700">{{ $message }}</span>@enderror

                      @if (session()->has('message'))
                      <span class="text-green-700">{{ session('message') }}</span>
                      @endif
                    </div>
          
          
                    <button wire:click.prevent="insertTeam"
            class="middle none center rounded-lg bg-blue-700 py-3 w-full font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-700/20 transition-all hover:shadow-lg hover:shadow-blue-700/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true"
          >
           Add Team
          </button>
                    </div>
                  </form>

                  <div class="flex flex-col m-10 items-center justify-center">
                  <h3 class="block font-sans mb-5 text-2xl font-thin leading-snug tracking-normal text-inherit antialiased">
                    Team List
                  </h3>       

                  <table class="w-full rounded-lg border text-center border-none shadow-lg bg-slate-50">
      <tr>
        <td> No. </td>
      <td> Name </td>
      <td> Action {{$deleteTeamId}} </td> 
      </tr>
    @foreach($teams as $team)
    
    <tr class="bg-white rounded-lg" wire:key="team-{{$team->id}}">
      <td class="font-light"> {{++$x}}. </td>
      <td class="font-light"> {{$team->team_name}} </td>
      <td class="font-light"> 
        <div class="flex flex-row justify-center gap-3">
        <button wire:key="showTeam-{{$team->id}}"> <i class="material-icons"> visibility </i> </button>
        <button wire:key="editTeam-{{$team->id}}"> <i class="material-icons"> edit </i> </button> 
        <button onclick="confirm('Are you sure you want to delete this team?')" wire:click="deleteTeamId({{$team->id}})"> <i class="material-icons"> delete </i> </button>
        </div>
      </td>
    </tr>
  
    @endforeach
  </table>
                  </div>
                  
    
                  </div>
          </div>

        </div>
        <div class="hidden opacity-0 flex justify-center w-full" id="addCandidates" wire:ignore.self role="tabpanel">
            <div class="shadow-md border bg-white w-full rounded-lg">
              <form>
              <div class="flex flex-col gap-10 justify-center items-center m-5">
                <div class="relative h-10 w-full min-w-[200px]">
                  <select wire:model="team_id" class="peer h-full w-full rounded-[7px] border border-black border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 empty:!bg-red-700 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                    <option>...</option>
                    @foreach($teams as $team)
                    <option value="{{value($team->id)}}">{{$team->team_name}}</option>
                    @endforeach
                  </select>
                  <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
                    Select a Team
                  </label>
                  @error('team_id') <span class="text-red-700">{{ $message }}</span>  @enderror
                  @if (session()->has('message'))
               <span class="text-green-700">{{ session('message') }}</span>
               @endif
                </div>
                <div class="flex flex-row items-center justify-between w-full">
                  <h1> Candidate: </h1>
                <button
    class="select-none rounded-lg bg-blue-700 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-700/20 transition-all hover:shadow-lg hover:shadow-blue-700/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    type="button"
    data-dialog-target="sign-in-dialog"
  >
    Add
  </button>

                </div>
       <!-- Modal -->
       <div wire:ignore.self
       data-dialog-backdrop="sign-in-dialog"
       data-dialog-backdrop-close="true"
       class="flex justify-center items-center pointer-events-none fixed inset-0 z-[999] h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300"
     >
       <div wire:ignore.self
         data-dialog="sign-in-dialog"
         class="relative mx-auto flex w-full lg:w-1/2 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md"
       >
           
         <div class="flex flex-col gap-4 p-6">
         
             <h3 class="block font-sans text-2xl font-light leading-snug tracking-normal text-black antialiased">
                 Add Striker Candidate
               </h3>

               <div class="flex flex-col items-center justify-center">
                <input wire:model="photo" type="file" class="hidden" id="photo">
                <label for="photo">
                  @if($success == 1)
                       <img class="relative inline-block h-36 w-36 rounded-full object-cover object-center"
                       alt="Image placeholder" src="{{ asset($filepath) }}">
                  @else
                  <img class="relative inline-block h-36 w-36 rounded-full object-cover object-center"
                  alt="Image placeholder" src="assets/users/default.jpg">
                  @endif
                </label>
                @error('photo') <span class="text-red-700">{{ $message }}</span>   @enderror
               </div>

           <div class="relative h-11 w-full min-w-[200px]">
             <input type="text" wire:model.defer="candidateName"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="behtmlFore:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Name
             </label>
           </div>
           <div class="flex flex-col w-full lg:flex-row gap-2 lg:gap-1 lg:justify-between">
           <div class="relative h-11 w-full lg:w-1/3 min-w-[200px]">
             <input type="number" wire:model.defer="stamina"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Stamina
             </label>
           </div>
     
           <div class="relative h-11 w-1/3 min-w-[200px]">
             <input type="number" wire:model.defer="posture"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Posture
             </label>
           </div>
     
           <div class="relative h-11 w-1/3 min-w-[200px]">
             <input type="number" wire:model.defer="finishing"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Finishing
             </label>
           </div>
           </div>

           <div class="flex flex-row gap-2 justify-between">
           <div class="relative h-11 w-full min-w-[200px]">
             <input type="number" wire:model.defer="dribbling"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Dribbling
             </label>
           </div>
           
           <div class="relative h-11 w-full min-w-[200px]">
             <input type="number" wire:model.defer="header"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Header
             </label>
           </div>
     
           <div class="relative h-11 w-full min-w-[200px]">
             <input type="number" wire:model.defer="attitude"
               class="peer h-full w-full rounded-md border border-black border-t-transparent bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-blue-700 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
               placeholder=" "
             />
             <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-700 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-blue-700 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-blue-700 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-blue-700 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-700">
               Attitude
             </label>
           </div>
         </div>
         </div>
         <div class="p-6 pt-0">
           <button wire:click="insertCandidate"
           data-dialog-close="true"
             class="block w-full select-none rounded-lg bg-gradient-to-tr from-blue-700 to-blue-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-700/20 transition-all hover:shadow-lg hover:shadow-blue-700/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
             type="button"
             data-ripple-light="true"
           >
             Add Candidate
           </button>
         </div>
       </div>
       </div>
       <!-- Modal -->
    </form>

    <table class="w-full rounded-lg border text-center border-none shadow-lg bg-slate-50">
      <tr>
        <td> No. </td>
      <td> Name </td>
      <td> Action </td>
      </tr>
    @foreach($alternatif as $alternatifs)
    
    <tr class="bg-white rounded-lg">
      <td  class="font-light"> {{++$i}}. </td>
      <td  class="font-light"> {{$alternatifs->name}} </td>
      <td  class="font-light"> 
        <div class="flex flex-row justify-center gap-3">
        <button> <i class="material-icons"> visibility </i> </button>
        <button> <i class="material-icons"> edit </i> </button> 
        <button onclick="confirm('Are you sure you want to delete this candidate?')" wire:click.prevent="deleteCandidateId({{$alternatifs->id}})"> <i class="material-icons"> delete </i> </button>
        </div>
      </td>
    </tr>
  
    @endforeach
  </table>
  </div>
          </p>
        </div>
      </div>
    </div>
                  <!-- Delete Modal -->
<div>
<div
data-dialog-backdrop="dialog" wire:ignore.self
data-dialog-close="true"
class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300"
>
<div
  data-dialog="dialog" wire:ignore.self
  class="relative m-4 w-2/5 min-w-[40%] max-w-[40%] rounded-lg bg-white font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased shadow-2xl"
>
  <div class="flex shrink-0 items-center p-4 font-sans text-2xl font-semibold leading-snug text-blue-gray-900 antialiased">
    Are you sure you want to delete this item?
  </div>
  <div class="relative border-t border-b border-t-blue-gray-100 border-b-blue-gray-100 p-4 font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased">
    Your action cannot be undone.
  </div>
  <div class="flex shrink-0 flex-wrap items-center justify-end p-4 text-blue-gray-500">
    <button
      data-ripple-dark="true"
      data-dialog-close="true"
      class="middle none center mr-1 rounded-lg py-3 px-6 font-sans text-xs font-bold uppercase text-black-500 transition-all hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    >
      Cancel
    </button>
    <button
      wire:click.prevent="delete"
      data-ripple-light="true"
      data-dialog-close="true"
      class="middle none center rounded-lg bg-gradient-to-tr from-red-600 to-red-400 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    >
      Confirm
    </button>
  </div>
</div>
</div>
</div>
  </div>      
      
    
            </div>
      </div>


